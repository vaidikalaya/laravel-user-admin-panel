
/*Generate Country Code*/
$(document).ready(function() {
	$("#selectedCountry").change(function(e){
		var countryId = document.getElementById("selectedCountry").value;
		$.ajax({
			type:'GET',
			url:"/getCountryIsdCode/"+countryId,
			success:function(data){
				document.getElementById("isdCode").value=data[0].isd_code;
				generateUserName(data[0].code);
			}
		});
	});
});


/*Generate User Name*/
function generateUserName(countryCode){
  var profileType=document.forms["signupForm"]["profileType"].value;
  document.getElementById("username").value=countryCode+''+profileType[0]+'A';
}

// OFCANVAS RESIZE
window.onresize = function() {
	if(window.innerWidth<=768){
		var element = document.getElementById("offcanvasExample");
		element.classList.remove("show");
	}else{
		var element = document.getElementById("offcanvasExample");
		element.classList.add("show");
	}  
}

//DATA TABLES
$(document).ready(function() {
	$('#dataTable').DataTable();
	$('#categoryDataTable').DataTable();
	$('#articleDataTable').DataTable();
	$('#tagDataTable').DataTable();
});

//SUMMER NOTE
$('#summernote').summernote({
	height: 350
});

//modals emitted
$(document).ready(function() {
	window.livewire.on('close-modal',()=>{
		$(".modal").modal('hide');
		location.reload();
	});
});

function showDeleteAlert(url,deletableId){
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if(result.isConfirmed){
			window.livewire.emit("delete-listener",{url:url, id : deletableId });
		}
	})
}