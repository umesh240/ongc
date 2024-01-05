rpt = {
	getHotels:function(thiss){
		$('.hotel_cd').html();
		var csrf_token = $('input[name="_token"]').val();
		var urlSave = $(thiss).attr('data-link');
		var eventcd = $(thiss).val();
		if(parseInt(eventcd) > 0){
			$.ajax({
				type: "POST",
				url: urlSave,
				data: { eventcd: eventcd, _token: csrf_token },
                beforeSend: function(){
                  $('.loading-container').css('display', 'flex');
                },
				success: function(result) {
					//console.log(result.opts);
					$('.hotel_cd').html(result.opts);
                    var hotel_cd = $('.hotel_cd').attr('data-hotel_cd');
                    if(parseInt(hotel_cd) > 0){
                        $('.hotel_cd').val(hotel_cd);
                    }
					var frdt = $(thiss).find('option:selected').attr('data-frdt');
					var todt = $(thiss).find('option:selected').attr('data-todt');
					if(frdt != undefined && frdt != ''){
						$('.fr_date').val(frdt).attr('min', frdt).attr('max', todt).removeAttr('disabled');
					}
					if(todt != undefined && todt != ''){
						$('.to_date').val(todt).attr('min', frdt).attr('max', todt).removeAttr('disabled');
					}
                    $('.loading-container').css('display', 'none');
				}
			});
		}
	},
}

$(document).ready(function () {
    /*$("#exportPDFButton").on("click", function () {
        const pdf = new jsPDF('p', 'pt', 'letter');
        const source = $("#exportData")[0];
        const specialElementHandlers = {
            '#ignoreElement': function (element, renderer) {
                return true;
            }
        };

        pdf.fromHTML(source, 15, 15, {
            'width': 180,
            'elementHandlers': specialElementHandlers
        });

        pdf.save('exported-document.pdf');
    });*/

    var eventcd_cnt = $('.eventcd').find('option').length;
    if(parseInt(eventcd_cnt) == 1){
        $('.eventcd').find('option:eq(0)').attr('selected', 'selected');
    }
    rpt.getHotels('.eventcd');
});



/*

document.getElementById('exportPDFButton').addEventListener('click', function () {
    // HTML content you want to export to PDF
    var container = document.getElementById('exportData');
    var htmlContent = container.innerHTML;
    // Create a definition for the PDF document
    var docDefinition = {
        content: [
            {
                text: 'HTML to PDF Example',
                style: 'header'
            },
            {
                text: htmlContent, // Add your HTML content here
                style: 'content'
            }
        ],
        styles: {
            header: {
                fontSize: 18,
                bold: true
            },
            content: {
                margin: [0, 15]
            }
        }
    };

    // Generate the PDF
    var pdfDoc = pdfMake.createPdf(docDefinition);
    pdfDoc.open(); // Opens the PDF in a new browser tab
});
*/
/*

document.getElementById('exportPDFButton').addEventListener('click', function () {
  var container = document.getElementById('exportData');
        var htmlContent = container.innerHTML;
        var csrf_token = $('input[name="_token"]').val();
        var urlSave = $(this).attr('data-link');
        // Send HTML content to the server using AJAX
        fetch(urlSave, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ _token: csrf_token, htmlContent: htmlContent}),
        })
        .then(response => response.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(new Blob([blob], { type: 'application/pdf' }));
            const a = document.createElement('a');
            a.href = url;
            a.download = 'exported.pdf';
            a.click();
        });
    });
*/