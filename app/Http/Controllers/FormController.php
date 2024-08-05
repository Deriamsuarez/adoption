<?php

namespace App\Http\Controllers;

use App\Mail\SentRequestToApplicant;
use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
    use App\Mail\SentRequestToPublisher;
    use App\Models\Pet;
    use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $forms = Form::with(['user', 'pet'])->get(); // Fetch all forms with related users and pets
        return view('forms.index', compact('forms')); // Assuming you have a Blade view to list forms
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('forms.create'); // View for creating a new form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    
    public function store(Request $request)
    {
        $request->validate([
            'members' => ['required', 'integer'],
            'all_agree' => ['required', 'boolean'],
            'animals' => ['required', 'boolean'],
            'why_adopt' => ['nullable', 'string'],
            'allowed_to_have_pets' => ['required', 'boolean'],
            'terms' => ['required', 'boolean'],
            'pet_id' => ['required', 'exists:pets,id'],
        ]);
    
        // Check if the user has already submitted a form for the same pet
        $existingForm = Form::where('user_id', auth()->id())
                            ->where('pet_id', $request->pet_id)
                            ->first();
    
        if ($existingForm) {
            $pet = $existingForm->pet()->first(); // Get pet details from the existing form
    
            return response()->json([
                'error' => 'You have already submitted a request for this pet. Please wait for a response.',
                'pet' => [
                    'name' => $pet ? $pet->name : 'Unknown',
                    'photo' => $pet ? $pet->photo : null,
                ],
            ], 400);
        }
    
        // If no existing form found, create a new form
        $form = new Form($request->all());
        $form->user_id = auth()->id(); // Associate the form with the currently authenticated user
        $form->save();
        
        $applicant = auth()->user();
        $pet = $form->pet()->first(); // Get the pet details from the new form
    
        // Find the user who published the pet
        $publisher = $pet->publisher; // Using the 'publisher' relationship
    
        if ($publisher) {
            // Send an email to the publisher
            Mail::to($publisher->email)->send(new SentRequestToPublisher($form, $pet, $applicant));

            Mail::to($applicant->email)->send(new SentRequestToApplicant($form, $pet));

        }
    
        return response()->json([
            'success' => 'Form created successfully!',
            'form' => $form,
            'pet' => [
                'name' => $pet ? $pet->name : null,
                'photo' => $pet ? $pet->photo : null,
            ],
        ], 201);
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param Form $form
     * @return Response
     */
    public function show(Form $form)
    {
        return view('forms.show', compact('form')); // View for showing form details
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Form $form
     * @return Response
     */
    public function edit(Form $form)
    {
        // Ensure that the user has permission to edit the form
        if ($form->user_id !== auth()->id()) {
            return redirect()->route('forms.index')->with('error', 'Unauthorized access');
        }

        return view('forms.edit', compact('form')); // View for editing the form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Form $form
     * @return Response
     */
    public function update(Request $request, Form $form)
    {
        // Ensure that the user has permission to update the form
        if ($form->user_id !== auth()->id()) {
            return redirect()->route('forms.index')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'members' => ['required', 'integer'],
            'all_agree' => ['required', 'boolean'],
            'animals' => ['required', 'boolean'],
            'why_adopt' => ['nullable', 'string'],
            'allowed_to_have_pets' => ['required', 'boolean'],
            'terms' => ['required', 'boolean'],
            'pet_id' => ['required', 'exists:pets,id'], // Add validation for pet_id
        ]);

        $form->update($request->all());

        return redirect()->route('forms.index')->with('success', 'Form updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Form $form
     * @return Response
     */
    public function destroy(Form $form)
    {
        // Ensure that the user has permission to delete the form
        if ($form->user_id !== auth()->id()) {
            return redirect()->route('forms.index')->with('error', 'Unauthorized access');
        }

        $form->delete();

        return redirect()->route('forms.index')->with('success', 'Form deleted successfully!');
    }
}
