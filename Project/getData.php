<?php
		include "Database.php";
		
		//connecting to MySQL database;
		$sql_connection  = new Database();
// .................................................................................................................
		//query to get all rows from table Members
		$query= "select * from Members";

		//execting the above query to retreve all rows from table
		$result = $sql_connection -> execute_query($query);

		//list of columns in table Members
		$columns_Members = array("PersonID","FName","LName","Street","City","Zip","HPhone","Email","UserID","Username");
		//creating table
		$html_page="<table border = \"1\">\n";
		//adding table header to html table
		$html_page.="<tr>";
		foreach($columns_Members as $column)
		{
			$html_page.="<th>".$column."</th>\n";
		}
		$html_page.="</tr>";

		
		//lopping through each row.
		while($row = mysqli_fetch_assoc($result))
		{	
			$html_page.="<tr>\n";
			//getting the value of each column of the row.
			foreach($columns_Members as $column)
			{
				$html_page.= "<td>".$row[$column]."</td>\n";
			}
			$html_page.="</tr>\n";
		}
		$html_page.="<table>b\n";
// ..................................................................................................................
	//similarly getting data from table users

		$query= "select * from Users";

		$result = $sql_connection -> execute_query($query);

		$columns_Members = array("UserID","PssWord");

		$html_page_2= "<table border = \"1\">";
		$html_page_2.="<tr>";

		foreach($columns_Members as $column)
		{
			$html_page_2.="<th>".$column."</th>\n";
		}
		$html_page_2.="</tr>";


		while($row = mysqli_fetch_assoc($result))
		{	
			$html_page_2.="<tr>\n";
			foreach($columns_Members as $column)
			{
				$html_page_2.= "<td>".$row[$column]."</td>\n";
			}
			$html_page_2.="</tr>\n";
		}
		$html_page_2.= "</table>";
		$ret=array("members"=> $html_page,"users"=> $html_page_2);

		echo json_encode($ret);




		
		


?> 