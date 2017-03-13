function getPinInfo(pinLatitude, pinLongitude) {

	var jsondata = (get json data from sampleData.json);
	var jsonobject = JSON.parse(jsondata);

	var idOfJsonEntryWereLookingFor = -1;

	var amountOfEntries = jsonobject.count; //get the value from the key called 'count', which is 3
	for(int i = 0; i < amountOfEntries; i++) { //for loop that increments i from 0 to 2 as it loops

		if(pinLatitude === jsonobject.data[i].lat  &&& pinLongitude === jsonobject.data[i].lon) {
			//IF PIN LATITUDE AND LONGITUDE ARE EQUAL TO JSON RECORDED LATITUDE AND LONGITUDE AT 'i'

			idOfJsonEntryWereLookingFor = jsonobject.data[i].id;

		}

	}

	//NOW if idOfJsonEntryWereLookingFor is -1, nothing was found that matches the pins coordinates
	//BUT if idOfJsonEntryWereLookingFor is >= 0, then it must have found something, and we have the id
	//it's time to grab the info we need and output it

	if(idOfJsonEntryWereLookingFor >= 0) {

		document.getElementById('info-name').innerHTML = jsonobject.data[idOfJsonEntryWereLookingFor].title;
		document.getElementById('info-rating').innerHTML = jsonobject.data[idOfJsonEntryWereLookingFor].rating;
		document.getElementById('info-type').innerHTML = jsonobject.data[idOfJsonEntryWereLookingFor].type;

	}

}
