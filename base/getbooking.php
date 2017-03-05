<?php
require_once 'common/session_check.php';
require_once 'common/dbconf.php';
$limit = 10;
$adjacent = 10;
 if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
$actionfunction = $_REQUEST['actionfunction'];
  call_user_func($actionfunction,$_REQUEST,$db,$limit,$adjacent);
}
function showData($data,$db,$limit,$adjacent){
  $page = $data['page'];
   if($page==1){
   $start = 0;
  }
  else{
  $start = ($page-1)*$limit;
  }
  $sql = "select * from booking order by booking_date desc";
  $rows  = $db->query($sql);
  $rows  = $rows->num_rows;

  $sql = "select * from booking order by booking_date desc limit $start,$limit";

  $data = $db->query($sql);
 $str = '';
  if($data->num_rows>0){
	 $str='<div class="row boking_th">';
   $str .= '<div class="col-md-4">Booking Name</div><div class="col-md-2">Type</div><div class="col-md-2">Amount</div><div class="col-md-2">Date</div>';
   $str .= '</div>';
   $str .= '<div class="row booking_cell">';
   while( $row = $data->fetch_array(MYSQLI_ASSOC)){
      $str .='<div class="col-md-4">'.$row["name"].'</div><div class="col-md-2">'.$row["booking_type"].'</div><div class="col-md-2">'.$row["amount_paid"].'</div><div class="col-md-2">'.$row["booking_date"].'</div><div class="col-md-2 btn-wrap"><a href="bookingdetails.php?id='.$row["id"].'" class="btn btn-default btn-details">View Details</a></div>';
       }
   }else{
    $str .= "<div class='col-xs-12'><div class='alert alert-warning'>No Bookings Found.</div></div>";
   }
   $str.='</div>';

echo $str;
pagination($limit,$adjacent,$rows,$page);
}
function pagination($limit,$adjacents,$rows,$page){
	$pagination='';
	if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);
	$next_='';
	$last='';
	if($lastpage > 1)
	{

		//previous button
		if ($page > 1)
			$prev_.= "<li><a href='?page=".$prev."'>prev</a></li>";
		else{
			$pagination.= "<li class='disabled'><a href='#!'>prev</a></li>";
			}

		//pages
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class='active'><a href='#!'>".$counter."</a></li>";
				else
					$pagination.= "<li><a href='?page=".$counter."'>".$counter."</a>";
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			$first='';
			if($page < 1 + ($adjacents * 2))
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active'><a href='#!'>".$counter."</a></li>";
					else
						$pagination.= "<li><a href='?page=".$counter."'>".$counter."</a></li>";
				}
			$last.= "<li><a href='?page=".$lastpage."'>Last</a></li>";
			}

			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<li><a href='?page=1'>First</a></li>";
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active'><a href='#!'>".$counter."</a></li>";
					else
						$pagination.= "<li><a href='?page=".$counter."'>".$counter."</a></li>";
				}
				$last.= "<li><a href='?page=$lastpage'>Last</a></li>";
			}
			//close to end; only hide early pages
			else
			{
			    $first.= "<li><a href='?page=1'>First</a></li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active'><a href='#!'>".$counter."</a></li>";
					else
						$pagination.= "<li><a href='?page=".$counter."'>".$counter."</a></li>";
				}
				$last='';
			}

			}
		if ($page < $counter - 1)
			$next_.= "<li><a href='?page=".$next.">next</a></li>";
		else{
			$pagination.= "<li class='disabled'><a href='#!'>next</a></li>";
			}
		$pagination = "<ul class='pagination' id='pagination'>".$first.$prev_.$pagination.$next_.$last;
		//next button

		$pagination.= "</ul>";
	}

	echo $pagination;
}
?>
