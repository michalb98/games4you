function showPriceNetto() {
            let pb = parseFloat(document.getElementById('brutto-admin-form').value).toFixed(2);;
            let pn = document.getElementById('netto-admin-form');

            if(pb != null)
                pn.value = parseFloat(pb/1.23).toFixed(2);

        }