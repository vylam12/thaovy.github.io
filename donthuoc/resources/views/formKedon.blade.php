
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/formKD.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Chakra+Petch:wght@300&family=Familjen+Grotesk&family=Nunito:wght@800&family=Raleway:wght@100&display=swap" rel="stylesheet">
    <title>KÊ ĐƠN THUỐC</title>

</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('dose.check',['id' => $patient->id, 'prescriptionId' => $prescriptionId])}}">
        @csrf 
        <div class="form-container">
            <label for="timkiemthuoc">Tìm kiếm tên thuốc:</label>                    
            <div class="autocomplete">
                <input id="searchThuoc" autocomplete="off"  type="text" name="searchThuoc" placeholder="Nhập tên thuốc">    
            </div>                 
            
            <label for="">Liều dùng</label>
            <input type="number" name="quantity_of_medicine" id="quantity_of_medicine">

            <label for="">Tần suất (lần/ngày)</label>           
            <div class="dose-container">
                <input type="text" name="frequency" id="frequency">                
            </div>
    
            <label for="">Ghi chú</label>
            <input type="text" name="note">

            <input type="hidden" name="_token" id="" value="<?php echo csrf_token(); ?>">
            
        </div>      
        <button class="add-btn"  type="submit">Thêm</button>
    </form>

    <script>
        function autocomplete(inp, arr) {
            var currentFocus;
            inp.addEventListener("input", function (e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                for (i = 0; i < arr.length; i++) {
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        b = document.createElement("DIV");
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        b.addEventListener("click", function (e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            inp.addEventListener("keydown", function (e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {
                        if (x) x[currentFocus].click();
                    }
                }
            });
            function addActive(x) {
                if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autocomplete-active");
            }
            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }
            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            document.addEventListener("click", function (e) {
                closeAllLists(e.target);
            });
        }
        @php
            $searchThuoc = [];
            $thuoc = DB::select('SELECT drug.name_drug, unit_drug.name_unitDr FROM drug JOIN detail_drug ON drug.id_drug = detail_drug.id_drug JOIN unit_drug ON detail_drug.id_unitDr = unit_drug.id_unitDr');
            if (!empty($thuoc)) {
                foreach ($thuoc as $t) {                    
                    array_push($searchThuoc, $t->name_drug. ' - ' . $t->name_unitDr);
                }
            }
        @endphp
    
        var searchThuoc = {!! json_encode($searchThuoc) !!};
        autocomplete(document.getElementById("searchThuoc"), searchThuoc);
    </script>
</body>
</html>
