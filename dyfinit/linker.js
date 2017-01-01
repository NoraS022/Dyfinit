/*
	Link dyfinit with your ajax function
*/

// List of libs: Jquery, ember, Angular, Om, backbone..

function dyfinit_linker(callback, path, data){
	// Example
	ajax("POST", path, callback, data);
}