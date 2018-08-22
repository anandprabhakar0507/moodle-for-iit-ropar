function check11(){
	var number=1;
	var dataString = 'function_num=' + number;
	$.ajax({
		type: "POST",
		url: "get_instructors.php",
		data: dataString,
		cache: false,
		success: function(html) {
			var result = $.parseJSON(html);
			var ind=1;
			for(i=0;i<result.length;i++,ind++){
				var table = document.getElementById("table_list_instructors");
				var row = table.insertRow(ind);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var cell5 = row.insertCell(4);
				cell1.innerHTML=result[i].Name;
				cell2.innerHTML = result[i].Department;
				cell3.innerHTML = result[i].Address;
				cell4.innerHTML = result[i].Contact_No;
				cell5.innerHTML = result[i].email;
			}
		}
	});
}
function check12(){
	var number=2;
	var dataString = 'function_num=' + number;
	$.ajax({
		type: "POST",
		url: "get_instructors.php",
		data: dataString,
		cache: false,
		success: function(html) {
			var result = $.parseJSON(html);
			var ind=1;
			for(i=0;i<result.length;i++,ind++){
				var table = document.getElementById("table_list_catalog");
				var row = table.insertRow(ind);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var cell5 = row.insertCell(4);
				var cell6 = row.insertCell(5);
				cell1.innerHTML=result[i].Course_ID;
				cell2.innerHTML = result[i].Title;
				cell3.innerHTML = result[i].Department;
				cell4.innerHTML = result[i].Credits;
				cell5.innerHTML = result[i].LTP;
				cell6.innerHTML = result[i].Prerequisite;
				if(cell6.innerHTML==''){
					cell6.innerHTML = 'None';
				}
			}
		}
	});
}
function check13(){
	var number=3;
	var dataString = 'function_num=' + number;
	$.ajax({
		type: "POST",
		url: "get_instructors.php",
		data: dataString,
		cache: false,
		success: function(html) {
			var result = $.parseJSON(html);
			var ind=1;
			for(i=0;i<result.length;i++,ind++){
				var table = document.getElementById("table_current_courses");
				var row = table.insertRow(ind);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var cell5 = row.insertCell(4);
				var cell6 = row.insertCell(5);
				var cell7 = row.insertCell(6);
				cell1.innerHTML=result[i].Course_ID;
				cell2.innerHTML = result[i].Title;
				cell3.innerHTML = result[i].Instructor_id;
				cell4.innerHTML = result[i].Credits;
				cell5.innerHTML = result[i].LTP;
				cell6.innerHTML = result[i].Slot;
				cell7.innerHTML = result[i].Prerequisite;
				if(cell7.innerHTML==''){
				cell7.innerHTML = 'None';
				}
			}
		}
	});
}
function check14(){
	var number=4;
	var dataString = 'function_num=' + number;
	$.ajax({
		type: "POST",
		url: "get_instructors.php",
		data: dataString,
		cache: false,
		success: function(html) {
			var result = $.parseJSON(html);
			var ind=1;
			for(i=0;i<result.length;i++,ind++){
				var table = document.getElementById("table_current_courses");
				var row = table.insertRow(ind);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var cell5 = row.insertCell(4);
				var cell6 = row.insertCell(5);
				var cell7 = row.insertCell(6);
				var cell8 = row.insertCell(7);
				cell1.innerHTML=result[i].firstname;
				cell2.innerHTML = result[i].lastname;
				cell3.innerHTML = result[i].email;
				cell4.innerHTML = result[i].phone_number;
				cell5.innerHTML = result[i].Department;
				cell6.innerHTML = result[i].advisor_id;
				cell7.innerHTML = result[i].cgpa;
				cell8.innerHTML = result[i].current_semester;
			}
		}
	});
}