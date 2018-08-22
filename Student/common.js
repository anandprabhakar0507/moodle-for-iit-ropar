
function check11(){
	// alert('fk');
	var number=1;
	var dataString = 'function_num=' + number;
   	$.ajax({
		type: "POST",
		url: "get_courses.php",
		data: dataString,
		cache: false,
		success: function(html) {
			var result = $.parseJSON(html);

			var ind=1;
			for(i=0;i<result.length;i++,ind++){
			var table = document.getElementById("rwd-table");
			var checkbox = document.createElement('input');
			checkbox.type = "checkbox";
			checkbox.name = "id"+ind;
			checkbox.value = result[i].Course_code;
			checkbox.id = "id"+ind;
			checkbox.className="idc";
			checkbox.onclick=activate_button;
			var label = document.createElement('label')
			label.htmlFor = "id"+ind;
			label.appendChild(document.createTextNode(result[i].Course_code));


			var row = table.insertRow(ind);
			var cell1 = row.insertCell(0);
		    var cell2 = row.insertCell(1);
		    var cell3 = row.insertCell(2);
		    var cell4 = row.insertCell(3);
		    var cell5 = row.insertCell(4);
		    var cell6 = row.insertCell(5);
		    var cell7 = row.insertCell(6);
		    var cell8 = row.insertCell(7);
		    var cell9 = row.insertCell(8);
		    
		    cell1.appendChild(checkbox);
			cell1.appendChild(label);
		    cell2.innerHTML = result[i].Course_name;
		    cell3.innerHTML = result[i].Instructor_id;
		    cell4.innerHTML = result[i].Credits;
		    cell5.innerHTML = result[i].LTP;
		    cell6.innerHTML = result[i].Slot;
		    cell7.innerHTML = result[i].prerequisite1;
		    cell8.innerHTML = result[i].cgpa_constraint;
		    cell9.innerHTML = result[i].allowed_batches;
		    // cell8.innerHTML = result[i].prerequisite2;
		    if(cell7.innerHTML==''){
		    cell7.innerHTML = 'None';
		    }
		    if(cell8.innerHTML=='0'){
		    cell8.innerHTML = 'No constraint';
		    }
		    if(cell9.innerHTML==''){
		    cell9.innerHTML = 'No constraint';
		    }
		}

		}
		});
   	check12(1);
}

function check12(param1){
	var number=2;
	var dataString = 'function_num=' + number;
   	$.ajax({
		type: "POST",
		url: "get_courses.php",
		data: dataString,
		cache: false,
		success: function(html2) {
			var result = $.parseJSON(html2);
			var ind=1;
			var p_ind=1;
			var c_ind=1;
			for(i=0;i<result.length;i++){
			if((param1==2)&&(result[i].Status)==0){
				ind--;
				continue;
			}
			if(param1!=3){
			if(result[i].Status==1){
			var table = document.getElementById("table_taken_courses");
			ind=c_ind;
			c_ind++;
			}
			else{
			var table = document.getElementById("table_pending_courses");	
			ind=p_ind;
			p_ind++;
			}
			}
			else{
				var table = document.getElementById("table_taken_courses");
				if(ind!=1)
				ind++;
			}
			var button = document.createElement("button");
			button.innerHTML = "&#x274C;";
			button.id=result[i].Course_code;
			button.className="dynamic";
			var row = table.insertRow(ind);
			var cell1 = row.insertCell(0);
		    var cell2 = row.insertCell(1);
		    var cell3 = row.insertCell(2);
		    var cell4 = row.insertCell(3);
		    var cell5 = row.insertCell(4);
		    var cell6 = row.insertCell(5);
		    if(param1==1)
		    var cell7 = row.insertCell(6);
		    cell1.innerHTML = result[i].Course_code;
		    cell2.innerHTML = result[i].Course_name;
		    cell3.innerHTML = result[i].Instructor_id;
		    if(param1!=3){
			    cell4.innerHTML = result[i].Credits;
			    cell5.innerHTML = result[i].LTP;
			    cell6.innerHTML = result[i].Slot;
			}
			if(param1==3){
				cell4.innerHTML = result[i].Semester;
			    cell5.innerHTML = result[i].Year;
			    cell6.innerHTML = result[i].Grade;	
			}
		    if(param1==1)
		    cell7.appendChild(button);
		}

		},
		complete: function(){
			$(".dynamic").click(function(){
			var dataString='id=' + this.id;
			$.ajax({
			type: "POST",
			url: "delete_course.php",
			data: dataString,
			cache: false,
			success: function(html) {
			var result = html;	
            window.location.reload();
			}
			});
		 });
		}
		});
}

function activate_button(){
	var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
	if(checkedOne==true){
		document.getElementById('save_btn').style.visibility = 'visible';
	}
	else{
		document.getElementById('save_btn').style.visibility = 'hidden';
	}
}

function proceed_data(){
    var courses = [];
    $('#rwd-table tr').each(function(){
	    $(this).find('td').has( 'input[type=checkbox]:checked' ).each(function(){
	        courses.push($(this).find(".idc").val());
	    })
	})
    var jsonString = JSON.stringify(courses);
   	$.ajax({
        type: "POST",
        url: "add_courses_student.php",
        data: {data : jsonString}, 
        cache: false,
        success: function(html){
        	var result = html;
        	if(result.indexOf("Success")>=0)
            window.location.reload(2);
        	else{
        		alert('You can\'t register more than one course in the same slot!!');
        		setTimeout(function(){ window.location.reload(2); }, 3000);
        	}
        }
    });
}

function check3(){
	var number=10;
	var cg=document.getElementById("cgpa");
	var dataString = 'function_num=' + number;
   	$.ajax({
		type: "POST",
		url: "get_courses.php",
		data: dataString,
		cache: false,
		success: function(html) {
			var result = $.parseJSON(html);
			var ind=1;
			for(i=0;i<result.length;i++,ind++){
				var table = document.getElementById("table_taken_courses");
				var row = table.insertRow(ind);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var cell5 = row.insertCell(4);
				var cell6 = row.insertCell(5);
				cell1.innerHTML = result[i].Student_id
				cell2.innerHTML = result[i].Course_id;
				cell3.innerHTML = result[i].Ins_id;
				cell4.innerHTML = result[i].Semester;
				cell5.innerHTML = result[i].Year;
				cell6.innerHTML = result[i].Grade;
				cg.innerText="Current CGPA: "+result[i].CGPA;
			}
		}
	});
}

function check_registration(){	
	var number=101;
	var dataString = 'function_num=' + number;
	var type=0;
   	$.ajax({
		type: "POST",
		url: "get_courses.php",
		data: dataString,
		cache: false,
		success: function(html) {
			if(html==1){
				type=1;
			}
			else{
				window.location="dashboard.php";
			}	
		},complete: function(){
			if(type==1){
				check11();
			}
		}
	});
}