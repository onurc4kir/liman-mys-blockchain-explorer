<script>
    function getLatestNews(){
        showSwal("{{__('Yükleniyor...')}}", 'info');
        let data = new FormData();

        request("{{API('getLatestNews')}}", data, function(response) {
            //response = JSON.parse(response);
            $('.news').html(response);
            console.log("son haberler geldi");
            console.log(response);
            Swal.close();
        }, function(error) {
            response = JSON.parse(error);
            if(response.status == 404) {
                console.log("Error Oluştu");
                Swal.close();
            } else {
                showSwal(response.message, 'error');
            }
        });
        
    }
</script>