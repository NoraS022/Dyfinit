// ajax function

function ajax(protocol = "GET", url = "", callback = function(response){ console.log(response); }, data = null){
	
	// Build data
	var formData = null;
	if(data !== null){
		formData = new FormData();
		for(var instance in data){
			formData.append(instance, data[instance]);
		}
	}

	// Build essential ajax components
	var xhr = new XMLHttpRequest();
	xhr.open(protocol, url, true);
	
	// Check for state updates
	xhr.onreadystatechange = function(){
		if(xhr.readyState === XMLHttpRequest.DONE){
			if(xhr.status === 200){
				callback(xhr.responseText);
			}
			else{
				callback("Error code: " + xhr.status);
			}
        }
	}

	// Send it!
	xhr.send(formData);
}