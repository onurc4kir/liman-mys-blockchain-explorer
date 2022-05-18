<script>
    let selectedSymbol = null
    function updateReport(arrOfValues){
        let rsiReport = ""
        let emaslow = -1
        let emafast = -1
        let positiveIndicators = 0
        arrOfValues.forEach(e => {
            if (e.id == "rsi") {
                if(e.value>80){
                    rsiReport += "RSI değeri 80 üzerinde bu bize piyasaların bir doygunluğa ulaşmaya başladığını ve alım yönlü kararlarda dikkatli olmamız gerektiği bildirir. "
                } else if(e.value<30){
                    rsiReport += "RSI değeri 30 altındadır bu bize piyasaların yoğun satış baskısına uğradığını göstermektedir. Bu aşamada satış yönlü kararlarda dikkatli olunmalıdır. "
                    positiveIndicators += 1
                }else{
                    rsiReport += "RSI değeri net bir bilgi vermemektedir. "
                }
            }else if (e.id == "cmf") {
                if (e.value>0) {
                    rsiReport += "CMF değeri 0'dan büyük bu trendin devam etme eğiliminde olduğunu gösteriyor. "
                    positiveIndicators += 1
                }else{
                    rsiReport += "CMF değeri 0'dan küçük bu trendin negatif yönde devam etme eğiliminde olduğunu gösteriyor. "
                }
                
            }else if (e.id == "adx") {
                if (e.value>50) {
                    rsiReport += "ADX verisi 50'den büyük trendin güçlü bir şekilde devam edeceğini belirtiyor."

                }else{
                    rsiReport += "ADX verisi 50'den küçük trendin zayıfladığını gösteriyor. Önümüzdeki süreçte yatay piyasayla veya trend dönüşüyle karşılaşmamız muhtemel. "
                }
                
            }else if(e.id == "ema_slow"){
                emaSlow = e.value
            }else if(e.id == "ema_fast"){
                emaFast = e.value
            }
        });

        if (emaFast>emaSlow) {
            rsiReport += "Hızlı hareketli ortalama yavaş hareketli ortalamanın altında bu da bize trendin aşağı yönlü devam ettiğini gösteriyor. "
        } else {
            rsiReport += "Hızlı hareketli ortalama yavaş hareketli ortalamanın üstünde bu da bize trendin yukarı yönlü devam ettiğini gösteriyor. "
            positiveIndicators += 1
        }
        $("#currency-symbol").html(selectedSymbol || "BTC")
        const positiveReportContent = "Totalde " + positiveIndicators +" adet pozitif veriye sahibiz."
        //$("#positiveReport").html(positiveReportContent)
        $("#report").html(rsiReport)

        $('#report').css({
            'margin': '6px', 
            'padding':'10px',
            'background-color': positiveIndicators>1 ?'#148F77':'#B03A2E',
            'border-radius':'16px',
            'font-size':'18px',
            'color':'white',
            'margin-top':'16px',
        
        });

    }
    function getCoinAnalyze(symbol){
        showSwal("{{__('Yükleniyor...')}}", 'info');
        let data = new FormData();
        symbol = selectedSymbol ||  "BTC"
        data.append('symbol', symbol);
        request("{{API('getBtcAnalyze')}}", data, function(response) {
            console.log("analyze veriler geldi");
            let res = JSON.parse(response);
            console.log(res);
            console.log(res.message.data)
            $('#indicator-table #sutun').empty()
            $('#indicator-table #satir').empty()
             $.each(res.message.data, function (key, val) {
                $('#indicator-table #sutun').append($('<th>').text(val.id.toUpperCase() ));
                $('#indicator-table #satir').append($('<td>').text(parseFloat(val.result.value).toFixed(3)));

            });

            updateReport(res.message.data)
            
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

    function lineOnClickEvent(node){
        console.log("satır tetiklendi");
        console.log(node);
        selectedSymbol = $(node).children("#symbol").html()
       $("#coin-analiz").click()
    }
    
</script>