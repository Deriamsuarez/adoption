<x-mail::message>
# Nueva solicitud de adopción

Hola,

Has recibido una nueva solicitud de adopción para **{{ $pet->name }}**.

**Detalles de la solicitud:**

- **Miembros en la familia que quiere adoptar:** {{ $form->members }}
- **Todos están acuerdo con la adopción:** {{ $form->all_agree ? 'Sí' : 'No' }}
- **Tienen otros animales:** {{ $form->animals ? 'Sí' : 'No' }}
- **Es permitido tener mascotas donde viven:** {{ $form->allowed_to_have_pets ? 'Sí' : 'No' }}

- **Motivo para adoptar:** 
{{ $form->why_adopt ?? 'No especificado' }}

**Detalles del solicitante:**

- **Nombre:** {{ $applicant->name }}
- **Email:** {{ $applicant->email }}
- **Edad:** {{ $applicant->age }}
- **Teléfono Móvil:** {{ $applicant->mobile }}
- **Teléfono Fijo:** {{ $applicant->phone }}


<x-mail::button :url="route('pet.view', ['slug' => $pet->slug])">
Ver detalles del cachorro
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
