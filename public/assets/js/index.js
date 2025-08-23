$(document).ready(function () {
    
    function formatToBRL(value) {
        if (!value) return '';
        
        // Remove tudo que não for número
        let numericValue = value.replace(/\D/g, '');
        
        if (numericValue === '') return '';
        
        // Converte para número com 2 casas decimais
        let floatValue = parseFloat(numericValue) / 100;
        
        return floatValue.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    }

    // Evento para formatar em tempo real
    $('#price-min, #price-max').on('input', function() {
        let formatted = formatToBRL($(this).val());
        $(this).val(formatted);
    });

});