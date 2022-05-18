<script>
    function exploreBlockchain(){
        showSwal("{{__('Yükleniyor...')}}", 'info');
        let data = new FormData();

        request("{{API('listTopCoins')}}", data, function(response) {
            $('.main-explorer').html(response);
            console.log("explorer veriler geldi");
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