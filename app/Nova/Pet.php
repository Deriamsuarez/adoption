<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Pet extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Pet>
     */
    public static $model = \App\Models\Pet::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Nombre', 'name')->sortable()->rules('required', 'max:255'),
            Slug::make('Slug')->from('name')->sortable()->rules('required', 'max:255'),
            Textarea::make('Descripción', 'description')->rules('required'),
            BelongsTo::make('Raza', 'breed', 'App\Nova\Breed')->rules('required'),
            Select::make('Tipo', 'type')->options([
                'Dog' => 'Perro',
                'Cat' => 'Gato',
                'Other' => 'Otro',
            ])->displayUsingLabels()->rules('required'),
            Image::make('Foto', 'photo')->rules('required'),
            Select::make('Género', 'gender')->options([
                'Male' => 'Macho',
                'Female' => 'Hembra',
            ])->displayUsingLabels()->rules('required'),
            Number::make('Peso', 'weight')->step(0.01)->nullable(),
            Select::make('Nivel de energía', 'energy_level')->options([
                'Low' => 'Bajo',
                'Medium' => 'Medio',
                'High' => 'Alto',
            ])->displayUsingLabels()->rules('required'),
            Select::make('Edad', 'age')->options([
                'Baby' => 'Bebé',
                'Young' => 'Joven',
                'Adult' => 'Adulto',
                'Senior' => 'Viejo',
            ])->displayUsingLabels()->rules('required'),
            Select::make('Tamaño actual', 'current_size')->options([
                'Small' => 'Pequeño',
                'Medium' => 'Mediano',
                'Large' => 'Grande',
            ])->displayUsingLabels()->rules('required'),
            Select::make('Tamaño adulto', 'adult_size')->options([
                'Small' => 'Pequeño',
                'Medium' => 'Mediano',
                'Large' => 'Grande',
            ])->displayUsingLabels()->rules('required'),
            Select::make('Nivel de entrenamiento', 'training_level')->options([
                'Basic' => 'Básico',
                'Intermediate' => 'Intermedio',
                'Advanced' => 'Avanzado',
            ])->displayUsingLabels()->rules('required'),
            Select::make('Pelaje', 'coat')->options([
                'Short' => 'Corto',
                'Medium' => 'Medio',
                'Long' => 'Largo',
                'Curly' => 'Rizado',
                'Hairless' => 'Sin pelo',
            ])->displayUsingLabels()->rules('required'),
            BelongsTo::make('Provincia', 'province', 'App\Nova\Province')->rules('required'),
            Select::make('Temperamento', 'temperament')->options([
                'Passive' => 'Pasivo',
                'Calm' => 'Tranquilo',
                'Aggressive' => 'Agresivo',
                'Friendly' => 'Amistoso',
                'Playful' => 'Juguetón',
                'Shy' => 'Tímido',
            ])->displayUsingLabels()->nullable(),
            Boolean::make('Vacunado', 'vaccinated')->default(false),
            Boolean::make('Desparacitado', 'dewormed')->default(false),
            Boolean::make('Castrado', 'neutered')->default(false),
            Boolean::make('Necesidades especiales', 'special_needs')->default(false),
            Trix::make('Notas de necesidades especiales', 'special_needs_notes')->nullable(),
            Trix::make('Historial médico', 'medical_history')->nullable(),
            BelongsTo::make('Publicado por', 'publisher', 'App\Nova\User'),
            BelongsToMany::make('Files')->showCreateRelationButton(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
