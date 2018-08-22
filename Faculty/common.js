
function check11(){
       
	var number=1;
	var dataString = 'function_num=' + number;
   	$.ajax({
               
		type: "POST",
		url: "p1_get_courses.php",
		data: dataString,
		cache: false,
		success: function(html) {
			var result = $.parseJSON(html);
			var ind=1;
			for(i=0;i<result.length;i++,ind++){
				var table = document.getElementById("rwd-table");
				var btn = document.createElement("BUTTON");        // Create a <button> element
				var t = document.createTextNode("Add");       // Create a text node
				btn.appendChild(t);
				btn.id=ind;
				btn.className="xyz";
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
				var cell10 = row.insertCell(9);
				var cell11 = row.insertCell(10);
				cell1.innerHTML = result[i].Course_ID
				cell7.innerHTML='<input type="text" name="slot" placeholder="Select Slot" class="text_box"/>'
				cell11.appendChild(btn);
				cell2.innerHTML = result[i].Title;
				cell3.innerHTML = result[i].Department;
				cell4.innerHTML = result[i].Credits;
				cell5.innerHTML = result[i].LTP;
				cell6.innerHTML='<input type="text" name="prerequisite" placeholder="No prerequisite" value="'+result[i].Prerequisite+'" class="text_box"/>'
				cell8.innerHTML='<input type="text" value="1000" name="max" placeholder="Max Students" class="text_box"/>'
				cell9.innerHTML='<input type="text" name="batches" placeholder="Allowed Batches" class="text_box"/>'
				cell10.innerHTML='<input type="text" value="0" name="cgpa" placeholder="CGPA constraint" class="text_box"/>'		    
			}
		},
		complete: function(){
			$(".xyz").click(function(){
				var x=this.id;
    			var courses = [];
    			var table = document.getElementById("rwd-table");
    			var course_code=table.rows[x].cells[0].innerHTML;
    			var title=table.rows[x].cells[1].innerHTML;
    			var department=table.rows[x].cells[2].innerHTML;
    			var credits=table.rows[x].cells[3].innerHTML;
    			var ltp=table.rows[x].cells[4].innerHTML;
    			var prerequisite=document.getElementsByName('prerequisite')[x-1].value;
    			var slot=document.getElementsByName('slot')[x-1].value;
    			var max_students=document.getElementsByName('max')[x-1].value;
    			var allowed_batches=document.getElementsByName('batches')[x-1].value;
    			var cgpa_constraint=document.getElementsByName('cgpa')[x-1].value;
				var dataString = 'course_code=' + course_code + '&title=' + title + '&department=' +
				department + '&credits=' + credits + '&ltp=' + ltp + '&prerequisite=' + prerequisite +
				'&slot=' + slot+ '&max_students=' + max_students + '&allowed_batches=' + allowed_batches+'&cgpa_constraint=' + cgpa_constraint;
				$.ajax({
				type: "POST",
				url: "add_courses.php",
				data: dataString,
				cache: false,
				success: function(html) {
				var result = html;
					alert(result);
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
	        console.log($(this).siblings().find('.text_box').innerHTML);
	    })
	})

}

function process_data(){

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