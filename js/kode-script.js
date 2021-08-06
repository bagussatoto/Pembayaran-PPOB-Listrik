    var frame=document.getElementsByClassName('frame_popup');
	function modal(n){
		frame[n].style.display="block";
	}
	function tutup(n){
		frame[n].style.display="none";
	}
	function hasil(){
        var nama=document.getElementById("nama").value;
        var alamat=document.getElementById("alamat").value;
        var nomor=document.getElementById("nomor").value;
        var awal=document.getElementById("awal").value;
        var akhir=document.getElementById("akhir").value;
        var kwh=document.getElementById("kwh").value;
        var data='';
        data= data + 'Nama = '+ nama;
        data= data + '\nAlamat = '+ alamat;
        data= data + '\nNomor Seri = '+ nomor;
        data= data + '\nMeter Awal = '+ awal;
        data= data + '\nMeter Akhir = '+ akhir;
        data= data + '\nTegangan = '+ kwh +' VA';
        if(kwh == '450') {
            data= data + '\nTotal Bayar = Rp.'+((akhir-awal)*1100);
        } else if(kwh == '900') {
            data= data + '\nTotal Bayar = Rp.'+((akhir-awal)*1300);
        } else if(kwh == '1200') {
            data= data + '\nTotal Bayar = Rp.'+((akhir-awal)*1500);
        }
        document.getElementById("total").innerText=data;
    }