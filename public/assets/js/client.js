$(document).ready(function () {

    function exibirDataHoraAtual() {
        const agora = new Date();
        const data = agora.toLocaleDateString('pt-BR'); // Formato de data brasileiro
        const hora = agora.toLocaleTimeString('pt-BR'); // Formato de hora brasileiro
        const dataHoraFormatada = `${data} às ${hora}`;
        return dataHoraFormatada;
    }

    function formatarMoeda(valor) {
        if (valor === null || valor === undefined) {
          return ''; // Ou outra representação para valores vazios
        }
        const valorNumerico = typeof valor === 'string' ? parseFloat(valor) : valor;
        return 'R$ ' + valorNumerico.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function formatarDataISO(dataISO) {
        if (!dataISO) {
          return ''; // Ou outra representação para datas vazias
        }
        const date = new Date(dataISO);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Meses começam em 0
        const year = date.getFullYear();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
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
                title:`Clientes ${exibirDataHoraAtual()}`
            },
            {
                extend:'pdf',
                text:'<i class="fas fa-file-pdf"></i> PDF',
                className:'btn btn-danger btn-sm',
                exportedOptions:{
                    columns:':visible'
                },
                title:`Clientes ${exibirDataHoraAtual()}`
            },
            {
                extend:'print',
                text:'<i class="fas fa-print"></i> Imprimir',
                className:'btn btn-secondary btn-sm',
                exportedOptions:{
                    columns:':visible'
                },
                title:`Clientes ${exibirDataHoraAtual()}`
            }
        ],
        info:false,
        responsive: true
    });

});