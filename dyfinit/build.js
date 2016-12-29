/*	
*	Build the core frontend components for all Dyfinit elements
*/	

function Dyfinit(target, template, loadAmount, initialAmount, buffertPercent = 20){
	var self = this; // Create a closure (nessesary for the eventListener)
	this.readyState = false; // Will be true when it's ready for more fetches
	this.target = target;
	this.template = template;
	this.buffertPercent = buffertPercent;
	this.loadAmount = loadAmount;
	this.offset = 0; // Offset
	this.fetch(initialAmount); // Fetch the initial amount right away

	window.addEventListener("scroll", function(){
		if(document.body.scrollTop + (window.innerHeight * (1 + self.buffertPercent / 100))
			>= self.target.offsetHeight - 1){ // If screen bottom pixels + (buffert % of screen height) > (scrolled further than) end of loaded content
			if(self.readyState){ // Ready for another call
				self.readyState = false; // Not ready anymore
				self.fetch(); // Fetch more content
			}
		}
	});
}


Dyfinit.prototype.fetch = function(amount){
	var self = this; // Create a closure (nessesary for the ajax callback)
	this.readyState = false; // Prevent more fetches untill this is finnished

	if(typeof amount === "undefined"){ // Set a value if none was sent
		amount = this.loadAmount;
	}

	// Make the http fetches
	ajax("POST", "dyfinit/provider.php", function(response){
		var tempEl = null; // Temporary element
		response = JSON.parse(response); // Make an object out of the response json
		self.offset += parseInt(response.html.length); // Increment the offset by returned results

		// Build the response
		for(var i = 0; i < response.html.length; i++){
			// Build the result container
			tempEl = document.createElement("div");
			tempEl.innerHTML = response.html[i];
			// Append the result container to the target
			self.target.appendChild(tempEl);
		}

		// Check for more to fetch
		if(response.more){
			self.readyState = true; // Allow more fetches again
		}
	}, {amount: amount, offset: this.offset, template: this.template});
}

