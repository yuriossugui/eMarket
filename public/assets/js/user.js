$(document).ready(function () {

    function exibirDataHoraAtual() {
        const agora = new Date();
        const data = agora.toLocaleDateString('pt-BR'); // Formato de data brasileiro
        const hora = agora.toLocaleTimeString('pt-BR'); // Formato de hora brasileiro
        const dataHoraFormatada = `${data} às ${hora}`;
        return dataHoraFormatada;
    }

    $('#table').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>rtip",
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
        },
        buttons: [
            {
                extend:'excel',
                text:'<i class="fas fa-file-excel"></i> Excel',
                className:'btn btn-success btn-sm',
                exportedOptions:{
                    columns:':visible'
                },
                title:`Usuarios ${exibirDataHoraAtual()}`
            },
            {
                extend:'pdf',
                text:'<i class="fas fa-file-pdf"></i> PDF',
                className:'btn btn-danger btn-sm',
                exportedOptions:{
                    columns:':visible'
                },
                title:`Usuarios ${exibirDataHoraAtual()}`
            },
            {
                extend:'print',
                text:'<i class="fas fa-print"></i> Imprimir',
                className:'btn btn-secondary btn-sm',
                exportedOptions:{
                    columns:':visible'
                },
                title:`Usuarios ${exibirDataHoraAtual()}`
            }
        ],
        info:false,
        responsive: true
    });

});