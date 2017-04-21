function sortTable(n, id_name, row_sort_offset, num_column) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById(id_name);
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("tr");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
	//console.log(rows[0].getElementsByTagName("td")[n+1].className);
	var sort_type;
	if(rows[0].getElementsByTagName("td")[n+1].className == "is-num-col")
	{
		sort_type = "number";
	}
	else if(rows[0].getElementsByTagName("td")[n+1].className == "is-date-col")
	{
		sort_type = "date";
	}
	else
	{
		sort_type = "string";
	}
	if(sort_type == "string")
	{
		for (i = (row_sort_offset-1); i < (rows.length - 1); i++) {
		  //start by saying there should be no switching:
		  shouldSwitch = false;
		  /*Get the two elements you want to compare,
		  one from current row and one from the next:*/
		  x = rows[i].getElementsByTagName("td")[n];
		  y = rows[i + 1].getElementsByTagName("td")[n];
		  /*check if the two rows should switch place,
		  based on the direction, asc or desc:*/
		  if (dir == "asc") {
			if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			  //if so, mark as a switch and break the loop:
			  shouldSwitch= true;
			  break;
			}
		  } else if (dir == "desc") {
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			  //if so, mark as a switch and break the loop:
			  shouldSwitch= true;
			  break;
			}
		  }
		}
	}
	else 
	{
		for (i = (row_sort_offset-1); i < (rows.length - 1); i++) {
		  //start by saying there should be no switching:
		  shouldSwitch = false;
		  /*Get the two elements you want to compare,
		  one from current row and one from the next:*/
		  //console.log(rows[i].getElementsByTagName("td")[n].innerHTML);
		  x = parseInt(rows[i].getElementsByTagName("td")[n].innerHTML);
		  //console.log(x);
		  y = parseInt(rows[i + 1].getElementsByTagName("td")[n].innerHTML);
		  /*check if the two rows should switch place,
		  based on the direction, asc or desc:*/
		  if (dir == "asc") {
			if (x > y) {
			  //if so, mark as a switch and break the loop:
			  shouldSwitch= true;
			  break;
			}
		  } else if (dir == "desc") {
			if (x < y) {
			  //if so, mark as a switch and break the loop:
			  shouldSwitch= true;
			  break;
			}
		  }
		}	
	}
    
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
  
}