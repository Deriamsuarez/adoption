<x-mail::message>
# Confirmación de Solicitud

Hola {{ $form->user->name }},

Tu solicitud de adopción para **{{ $pet->name }}** ha sido enviada exitosamente.

**Detalles de la solicitud:**

- **Miembros en la familia que quiere adoptar:** {{ $form->members }}
- **Todos están de acuerdo con la adopción:** {{ $form->all_agree ? 'Sí' : 'No' }}
- **Tienen otros animales:** {{ $form->animals ? 'Sí' : 'No' }}
- **Es permitido tener mascotas donde viven:** {{ $form->allowed_to_have_pets ? 'Sí' : 'No' }}
- **Motivo para adoptar:** {{ $form->why_adopt ?? 'No especificado' }}

Mantente atento, quien hizo la publicación se pondrá en contacto contigo pronto.

Gracias por tu interés en adoptar un amigo.<br>
{{ config('app.name') }}
</x-mail::message>
