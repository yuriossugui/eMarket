document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('customFile').addEventListener('change', function(e) {
        var fileName = this.files[0] ? this.files[0].name : 'Escolha a imagem';
        this.nextElementSibling.innerText = fileName;
    
        if (this.files && this.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            var previewDiv = document.getElementById('preview');
            previewDiv.innerHTML = '<img src="'+ e.target.result +'" class="img-fluid img-thumbnail" alt="Pré-visualização">';
          }
          reader.readAsDataURL(this.files[0]);
        }
      });

});