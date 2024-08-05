function truncate(str, maxLength, ellipsis = '...') {
    // Verifica si la longitud de la cadena es mayor que la longitud deseada
    if (str.length > maxLength) {
        // Trunca la cadena y agrega puntos suspensivos al final
        return str.slice(0, maxLength - ellipsis.length) + ellipsis;
    }
    return str;
}

function formatPrice(price) {
    // Formatear el precio con separadores de miles y dos decimales
    return '$' + price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

function formatPhone(phoneNumber) {
    // Elimina todos los caracteres que no sean números
    const cleaned = phoneNumber.replace(/\D/g, '');

    // Verifica que el número tenga 10 dígitos
    if (cleaned.length !== 10) {
        return false; // o lanzar una excepción o manejar el error como prefieras
    }

    // Divide el número en las partes NXX-XXX-XXXX
    const areaCode = cleaned.substring(0, 3);
    const exchangeCode = cleaned.substring(3, 6);
    const subscriberNumber = cleaned.substring(6, 10);

    // Formatea el número
    const formattedNumber = `(${areaCode}) ${exchangeCode}-${subscriberNumber}`;

    return formattedNumber;
}

function  formatDate(dateString) {
    if (!dateString) return '';

    const date = new Date(dateString);

    const options = { year: 'numeric', month: 'long', day: 'numeric' };

    return date.toLocaleDateString('es-ES', options);
  }




export { truncate, formatPrice, formatPhone, formatDate }