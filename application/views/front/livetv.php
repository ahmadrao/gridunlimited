<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/styles.css' ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
		/* Hide scrollbar for Chrome, Safari and Opera */
		#tab::-webkit-scrollbar {
			display: none;
		}

		/* Hide scrollbar for IE and Edge */
		#tab {
			-ms-overflow-style: none;
		}

		/* .hover-style:hover {
			background: rgb(3, 66, 129);
			box-shadow: 2px 2px black;
			zoom: 102%;
		} */
	</style>
	<script>
		let secondsPassedPlayingTheVideo = 1;
		$(document).ready(function() {
			let videoChanged;

			let minutesLeftObject = {};
			$(this).scrollTop(0);
			tick();
		});


		function tick() {
			var d = new Date();
			time = formatAMPM(d);
			// console.log(time);
			$('#timeChanged').html('&nbsp;' + time);
			t = setTimeout(tick, 1000);
		}

		function hello(url) {
			// // console.log('hello');
			// alert(url);
			window.location.href = url;
		}

		function formatAMPM(date) {
			var hours = date.getHours();
			var minutes = date.getMinutes();
			var ampm = hours >= 12 ? 'PM' : 'AM';
			hours = hours % 12;
			hours = hours ? hours : 12; // the hour '0' should be '12'
			minutes = minutes < 10 ? '0' + minutes : minutes;
			var strTime = hours + ':' + minutes + ' ' + ampm;
			return strTime;
		}

		function play_video(link) {
			var video_frame = document.getElementById("video");
			video_frame.src = link + "?autoplay=1";
			//video_frame.pointer-events: none;
			// alert(link);
		}

		function play_first_video(link) {
			var video_frame = document.getElementById("video");
			video_frame.src = link + "?autoplay=1";
			alert(link);
		}
	</script>

</head>

<body style=" background-image:linear-gradient(to right, rgb(20, 20, 47), rgb(98, 193, 144));  overflow:auto;">

	<div class="bgimg-1" style="height: 48vh;display: block; min-height: 450px; clear: both;position: relative; ">
		<section id="myVideo" style="z-index:0px; overflow:hidden; ">
			<a class="nav-link" href="#" style="font-weight:bold; font-size:24px; color: white;">&emsp;&emsp;Gridunlimited <span class="sr-only">(current)</span></a>

			<div class="embed-responsive embed-responsive-16by9" style="height:360px;z-index:0px;" id="player">
			</div>

			<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
			<!--<div id="player"></div>-->
			<?php
			date_default_timezone_set('Asia/Kolkata');

			$tz = 'Asia/Karachi';
			$tz_obj = new DateTimeZone($tz);
			$today = new DateTime("now", $tz_obj);
			$time_in_24_formate = $today->format('H:i:s');
			$time_formatted = $today->format('g:i a'); // 5:04 pm
			// print_r($time_formatted);
			// exit();

			$sqls = $this->Video_model->new_videos_by_category($vid_cat);

			foreach ($sqls as $vid) {
				$vids[] = array("id" => $vid['id'], "category_id" => $vid['category_id'],  "video" => explode("?v=", $vid['video_url'])[1]);
			}
			// foreach ($this->Video_model->new_videos_by_category() as $vid) {
			// 	$vids[] = array("id" => $vid['id'],  "video" => explode("?v=", $vid['video_url'])[1]);
			// }

			$jvid = json_encode($vids);
			$next_video = $this->Video_model->next_video_by_category($vids[0]['id']);
			//$this->Video_model->start_video($sqls[0]['id']);
			?>
			<script>
				var minutesLeftArray = []; // This is to be used for calculating left minutes
				var obj = '<?php echo $jvid ?>';
				var site_url = '<?php echo site_url() ?>';
				var videosOBJ = JSON.parse(obj);
				var current_video = videosOBJ[0].video;
				var current_playing_video_id = videosOBJ[0].id;

				var previous_playing_video_id = videosOBJ[0].id;
				// // console.log(videosOBJ[0]);
				// //var started_time = videosOBJ[0].diff;
				// // console.log(videosOBJ);
				// var next_videos_by_category = videosOBJ.filter(videoOBJ => videoOBJ.category_id === videosOBJ[0].category_id);
				// var next_video = next_videos_by_category[1].video;
				// // console.log(next_video);
				// var next_playing_video_id = next_videos_by_category[1].id;
				<?php
				$next_video = $this->Video_model->next_video_by_category($vids[0]['id']);
				$video = explode("?v=", $next_video['video_url'])[1];
				?>
				var next_playing_video_id = '<?php echo $next_video['id']; ?>';
				var next_video = '<?php echo $video; ?>';
				// console.log(next_video);
				var key = 0;
				// 2. This code loads the IFrame Player API code asynchronously.
				var tag = document.createElement('script');
				//tag.src = "https://www.youtube.com/player_api";

				tag.src = "https://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

				// 3. This function creates an <iframe> (and YouTube player)
				//    after the API code downloads.
				var player;

				function onYouTubeIframeAPIReady() {
					player = new YT.Player('player', {
						height: '390',
						width: '640',
						videoId: current_video,
						events: {
							'onReady': onPlayerReady,
							'onStateChange': onPlayerStateChange
						}
					});
				}

				// 4. The API will call this function when the video player is ready.
				function onPlayerReady(event) {
					// if(started_time!="")
					// player.loadVideoById(current_video, "0", "large");
					// else


					var timeupdater = setInterval(function() {
						if (player.getPlayerState() == 1)
							onProgress(player);
					}, 100);

					event.target.playVideo();
				}

				// when the time changes, this will be called.
				function onProgress(p) {
					secondsPassedPlayingTheVideo = p.getCurrentTime();
					// // console.log(current_video);
					// // console.log(p.getCurrentTime());
					let z = p.getCurrentTime();
					let y = p.getDuration();
					// console.log(p.getDuration());
					if (y - z < 1) {
						// counters("midpoint"); 
						videoChanged = true;
					}
				}


				// 5. The API calls this function when the player's state changes.
				//    The function indicates that when playing a video (state=1),
				//    the player should play for six seconds and then stop.
				var done = false;

				function onPlayerStateChange(event) {
					if (event.data == YT.PlayerState.ENDED && !done) {
						//alert("Video Ended"+key);
						nextPlay();
						// // console.log(videosOBJ[key]);
						//$.ajax({url: site_url+"/Welcome/start_video/"+videosOBJ[key].id, success: function(result){ }});
					}
				}

				function nextPlay() {
					//$.ajax({url: site_url+"/Welcome/end_video/"+videosOBJ[key].id, success: function(result){ }});
					// console.log('Current Video');
					// console.log(next_video);
					player.loadVideoById(next_video);
					previous_playing_video_id = current_playing_video_id;
					current_playing_video_id = next_playing_video_id;
					current_video = next_video;

					<?php
					$next_video = $this->Video_model->next_video_by_category($next_video['id']);
					$video = explode("?v=", $next_video['video_url'])[1];
					?>
					next_playing_video_id = '<?php echo $next_video['id']; ?>';
					next_video = '<?php echo $video; ?>';
					// console.log('Next Video');
					// console.log(next_video);
					key++;
				}

				function stopVideo() {
					player.stopVideo();
				}
			</script>
			<?php $current_playing_video = '<script>document.write(current_video)</script>';
			?>
		</section>
	</div>
	<?php

	?>
	<script type="text/javascript">
		/*   function scollPos() {
            var div = document.getElementById("tab").scrollTop;
			if(div >=30){
				$(".bgimg-1").hide("slow");
				$("#tab").css("height","100vh");
			}
        }*/
	</script>
	<img src="<?php echo base_url() . "/assets/img/energy_icon.png" ?>" id="energyIcon" class="energyIcon" style="width: 1.6rem;height: 1.6rem;position: absolute;left: 16.4rem;margin-top: -19px; cursor: pointer;" alt="">
	<div class="timeline verticalLine" id="verticalLine" style="border-left: 3px solid green; height: 100%; left: 17rem; position: absolute;"></div>
	<div id="tab" class="table-responsive" style="height:100%; /* background-image:linear-gradient(45deg, rgb(91, 126, 141), rgb(47, 94, 79)); */ overflow-x: scroll;overflow-y: scroll; border:1px solid;">
		<table class="table" style="width: 2176px;">
			<tbody>

				<?php
				if ($vid_cat == "") {
					$p = 1;
					foreach ($cats as $category) {
						if ($this->Video_model->isvideos($category['id']) > 0) {


							if ($p == 1) {
								$x = $time_formatted;
				?>
								<tr style="display: flex;">
									<td style="width: 17rem; color:white; font-weight:bold;">&emsp;&emsp;Channels <br> &emsp;&emsp;<span id="timeChanged"><?php echo $time_formatted ?></span> </td>
									<?php

									foreach ($this->Video_model->all_videos_by_category($category['id']) as $v) {
									?>
										<?php
										$video_dur = date('H:i:s', strtotime($v['duration']));

										$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

										sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

										$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;


										?>
										<td style="width:<?php echo $time_seconds; ?>px; height:50px; text-align:left; color:white;">
											<?php
											echo $x;

											?>
										</td>
									<?php

										$x = date('H:i:s', strtotime($x));
										$video_dur = date('H:i:s', strtotime($v['duration']));

										$secs = strtotime($video_dur) - strtotime("00:00:00");
										$x = date("g:i a", strtotime($x) + $secs);
									}
									?>
									<td style="width:13.37rem; height:50px; text-align:left;  color:white;">
										<?php
										echo $x;

										?>
									</td>
								</tr>
							<?php
							}


							?>


							<tr style="display: flex;">
								<td class="hover-style" style="width:17rem; min-height: 7rem; cursor:pointer;margin-right: 7px; margin-bottom: 7px; border:3px solid black; /* border-radius: 15px; */ color:white; display: flex; align-items: center; font-weight:bold;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $this->Video_model->all_videos_by_category($category['id'])[0]['id']; ?>')"> &nbsp;&nbsp;<?php echo " " . $p; ?>&emsp;<img src="<?php echo ($category['image'] == "") ? base_url() . '/assets/uploads/nophoto.png' : base_url() . '/assets/uploads/' . $category['image']; ?>" height="20px" width="30px" />&nbsp;<?php echo  $category['category']; ?></td>
								<?php
								$c = 0;
								$previous_time = $time_formatted;
								foreach ($this->Video_model->all_videos_by_category($category['id']) as $v) {

									if ($c == 0 && $p == 1) {
								?>
										<?php
										$video_dur = date('H:i:s', strtotime($v['duration']));

										$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

										sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

										$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

										$time_minutes = $hours * 60 + $minutes;

										?>
										<td class="hover-style" id="videoID<?php echo $v['id']; ?>" style="width:<?php echo $time_seconds ?>px; min-height: 8rem; border:3px solid black; /* border-radius: 15px; */ color:white; cursor:pointer; margin-right: 7px; margin-bottom: 7px;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $v['id']; ?>')">
											&emsp;<?php echo $previous_time; ?>&nbsp;-
											<?php
											$previous_time = date('H:i:s', strtotime($previous_time));

											$video_dur = date('H:i:s', strtotime($v['duration']));

											$secs = strtotime($video_dur) - strtotime("00:00:00");
											$previous_time = date("g:i a", strtotime($previous_time) + $secs);
											// echo $previous_time . '  ' . '<span id="minutesLeftChanged' . $v["id"] . '">' . $time_minutes . '</span>' . ' Minutes Left';
											echo $previous_time;
											?>

											<br>
											<?php echo $v['title']; ?>
										</td>
										<script>
											var minutes_left = '<?php echo $time_minutes; ?>';
											var object = '<?php echo json_encode($v); ?>';
											var viddeo = JSON.parse(object);
											// // console.log(minutes_left);
											minutesLeftArray.push({
												video_id: viddeo.id,
												min_left: '<?php echo $time_minutes; ?>'
											});
										</script>
									<?php
									} else if ($c == 0) {
									?>
										<?php
										$video_dur = date('H:i:s', strtotime($v['duration']));

										$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

										sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

										$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

										$time_minutes = $hours * 60 + $minutes;
										?>
										<td class="hover-style" id="videoID<?php echo $v['id']; ?>" style="width:<?php echo $time_seconds ?>px;  min-height: 8rem; border:3px solid black; /* border-radius: 15px; */ color:white; cursor:pointer; margin-right: 7px; margin-bottom: 7px;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $v['id']; ?>')">
											&emsp;<?php echo $previous_time; ?>&nbsp;-
											<?php
											$previous_time = date('H:i:s', strtotime($previous_time));
											$video_dur = date('H:i:s', strtotime($v['duration']));
											$secs = strtotime($video_dur) - strtotime("00:00:00");
											$previous_time = date("g:i a", strtotime($previous_time) + $secs);
											// echo $previous_time . '  ' . '<span id="minutesLeftChanged' . $v["id"] . '">' . $time_minutes . '</span>' . ' Minutes Left';
											echo $previous_time;
											?>
											<br>
											<?php echo $v['title']; ?>
										</td>
										<script>
											var object = '<?php echo json_encode($v); ?>';
											var viddeo = JSON.parse(object);

											var oneMinDecreased = "oneMinuteDecreased" + viddeo.id;

											minutesLeftArray.push({
												video_id: viddeo.id,
												min_left: '<?php echo $time_minutes; ?>'
											});
										</script>


									<?php
									} else {
									?>
										<?php
										$video_dur = date('H:i:s', strtotime($v['duration']));

										$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

										sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

										$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

										// $time_minutes = $hours * 60 + $minutes;
										?>
										<td class="hover-style" id="videoID<?php echo $v['id']; ?>" style="width:<?php echo $time_seconds ?>px;  border:3px solid black; /* border-radius: 15px; */ color:white; cursor:pointer; margin-right: 7px; margin-bottom: 7px;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $v['id']; ?>')">
											&emsp;<?php echo $previous_time; ?>&nbsp;-
											<?php
											$previous_time = date('H:i:s', strtotime($previous_time));
											$video_dur = date('H:i:s', strtotime($v['duration']));
											$secs = strtotime($video_dur) - strtotime("00:00:00");
											$previous_time = date("g:i a", strtotime($previous_time) + $secs);
											echo $previous_time;
											?>
											<br>
											<?php echo $v['title']; ?>
										</td>
									<?php

									}
									$c++;
								}
								if ($c < 5) {
									for ($m = $c; $m < 5; $m++) {

									?>
										<td style="width:13.37rem; border:3px solid black; /* border-radius: 15px; */ margin-right: 7px; margin-bottom: 7px; color:white;">&emsp;<?php echo "No Videos Right Now"; ?></td>
									<?php
									}
								} else {
									//$c=6;
									$k = 272 * $c;
									?>
									<script>
										var tab = document.getElementById("tab");
										// tab.style.width="<?php echo $k;  ?>px"
									</script>
								<?php
								}
								?>
							</tr>
							<?php $p++;
						}
					}
				}
				//#########################     Page With ID Reload     #########################################3#####

				else {

					// echo $vid_cat;
					$this->db->where('id', $vid_cat);
					$catss = $this->db->get('videos')->result_array();
					// print_r($cats);
					// exit();
					$cat_id = $catss[0]['category_id'];
					// print_r($catss[0]);
					// exit();
					$p = 1;
					foreach ($cats as $category) {
						if ($this->Video_model->isvideos($category['id']) > 0) {
							if ($cat_id == $category['id']) {

								$x = $time_formatted;
							?>
								<tr style="display: flex;">
									<td style="width: 17rem; color:white; font-weight:bold;">&emsp;&emsp;Channels <br> &emsp;&emsp;<span id="timeChanged"><?php echo $time_formatted ?></span> </td>
									<?php

									foreach ($this->Video_model->all_videos_by_category($category['id']) as $v) {
										if ($v['id'] >= $vid_cat) {
											$video_dur = date('H:i:s', strtotime($v['duration']));

											$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

											sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

											$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

									?>
											<td style="width:<?php echo $time_seconds; ?>px; height:50px; text-align:left; color:white;">
												<?php
												echo $x;

												?>
											</td>
									<?php

											$x = date('H:i:s', strtotime($x));
											$video_dur = date('H:i:s', strtotime($v['duration']));

											$secs = strtotime($video_dur) - strtotime("00:00:00");
											$x = date("g:i a", strtotime($x) + $secs);
										}
									}
									?>
									<td style="width:13.37rem; height:50px; text-align:left;  color:white;">
										<?php
										echo $x;

										?>
									</td>

								</tr>
							<?php

							}
							?>
							<tr id="categ<?php echo $category['id']; ?>" class="<?php echo $p; ?>" style="display: flex;">
								<td class="hover-style" style="width:17rem; min-height: 7rem; cursor:pointer; border:3px solid black; /* border-radius: 15px; */ margin-right: 7px; margin-bottom: 7px; color:white; display: flex; align-items: center; font-weight:bold;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $this->Video_model->all_videos_by_category($category['id'])[0]['id']; ?>')"> &nbsp;&nbsp;<?php echo " " . $p; ?>&emsp;<img src="<?php echo ($category['image'] == "") ? base_url() . '/assets/uploads/nophoto.png' : base_url() . '/assets/uploads/' . $category['image']; ?>" height="20px" width="30px" />&nbsp;<?php echo  $category['category']; ?></td>
								<?php
								$c = 0;
								$viddeo_category_id = $this->Video_model->get_video_category($vid_cat);
								$previous_time = $time_formatted;
								foreach ($this->Video_model->all_videos_by_category($category['id']) as $v) {
									if ($v['id'] >= $vid_cat && $v['category_id'] == $viddeo_category_id) {
										if ($vid_cat == $v['id']) {
											$video_dur = date('H:i:s', strtotime($v['duration']));

											$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

											sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

											$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

											$time_minutes = $hours * 60 + $minutes;

								?>

											<td class="hover-style" id="videoID<?php echo $v['id']; ?>" style="width:<?php echo $time_seconds ?>px; min-height: 8rem;/* background-color:#034281; */border:3px solid black; /* border-radius: 15px; */ color:white; cursor:pointer; margin-right: 7px; margin-bottom: 7px;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $v['id']; ?>')">

												&emsp;<?php echo $previous_time; ?>&nbsp;-
												<?php
												$previous_time = date('H:i:s', strtotime($previous_time));

												$video_dur = date('H:i:s', strtotime($v['duration']));

												$secs = strtotime($video_dur) - strtotime("00:00:00");
												$previous_time = date("g:i a", strtotime($previous_time) + $secs);
												// echo $previous_time . '  ' . '<span id="minutesLeftChanged' . $v["id"] . '">' . $time_minutes . '</span>' . ' Minutes Left';
												echo $previous_time;
												?>

												<br>
												<?php echo $v['title']; ?>
											</td>
											<script>
												var minutes_left = '<?php echo $time_minutes; ?>';
												var object = '<?php echo json_encode($v); ?>';
												var viddeo = JSON.parse(object);
												// // console.log(minutes_left);
												minutesLeftArray.push({
													video_id: viddeo.id,
													min_left: '<?php echo $time_minutes; ?>'
												});
											</script>
										<?php
										} else {
											$video_dur = date('H:i:s', strtotime($v['duration']));

											$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

											sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

											$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

											$time_minutes = $hours * 60 + $minutes;
										?>
											<td class="hover-style" id="videoID<?php echo $v['id']; ?>" style="width:<?php echo $time_seconds ?>px; min-height: 8rem; border:3px solid black; /* border-radius: 15px; */ color:white; cursor:pointer; margin-right: 7px; margin-bottom: 7px;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $v['id']; ?>')">
												&emsp;<?php echo $previous_time; ?>&nbsp;-
												<?php
												$previous_time = date('H:i:s', strtotime($previous_time));
												$video_dur = date('H:i:s', strtotime($v['duration']));
												$secs = strtotime($video_dur) - strtotime("00:00:00");
												$previous_time = date("g:i a", strtotime($previous_time) + $secs);
												echo $previous_time;
												?>
												<br>
												<?php echo $v['title']; ?>
											</td>


										<?php
										}
									} else if ($v['category_id'] != $viddeo_category_id) {
										if ($c == 0) {
											$video_dur = date('H:i:s', strtotime($v['duration']));

											$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

											sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

											$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

											$time_minutes = $hours * 60 + $minutes;
										?>
											<td class="hover-style" id="videoID<?php echo $v['id']; ?>" style="width:<?php echo $time_seconds ?>px; border:3px solid black; /* border-radius: 15px; */ color:white; cursor:pointer; margin-right: 7px; margin-bottom: 7px;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $v['id']; ?>')">
												&emsp;<?php echo $previous_time; ?>&nbsp;-
												<?php
												$previous_time = date('H:i:s', strtotime($previous_time));
												$video_dur = date('H:i:s', strtotime($v['duration']));
												$secs = strtotime($video_dur) - strtotime("00:00:00");
												$previous_time = date("g:i a", strtotime($previous_time) + $secs);
												// echo $previous_time . '  ' . '<span id="minutesLeftChanged' . $v["id"] . '">' . $time_minutes . '</span>' . ' Minutes Left';
												echo $previous_time;
												?>
												<br>
												<?php echo $v['title']; ?>
											</td>
											<script>
												var object = '<?php echo json_encode($v); ?>';
												var viddeo = JSON.parse(object);

												var oneMinDecreased = "oneMinuteDecreased" + viddeo.id;

												minutesLeftArray.push({
													video_id: viddeo.id,
													min_left: '<?php echo $time_minutes; ?>'
												});
											</script>

										<?php
										} else {
											$video_dur = date('H:i:s', strtotime($v['duration']));

											$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $video_dur);

											sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

											$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

											// $time_minutes = $hours * 60 + $minutes;
										?>
											<td class="hover-style" id="videoID<?php echo $v['id']; ?>" style="width:<?php echo $time_seconds ?>px; border:3px solid black; /* border-radius: 15px; */ color:white; cursor:pointer; margin-right: 7px; margin-bottom: 7px;" onclick="hello('http://gridunlimited.com/index.php/welcome/index/<?php echo $v['id']; ?>')">
												&emsp;<?php echo $previous_time; ?>&nbsp;-
												<?php
												$previous_time = date('H:i:s', strtotime($previous_time));
												$video_dur = date('H:i:s', strtotime($v['duration']));
												$secs = strtotime($video_dur) - strtotime("00:00:00");
												$previous_time = date("g:i a", strtotime($previous_time) + $secs);
												echo $previous_time;
												?>
												<br>
												<?php echo $v['title']; ?>
											</td>
										<?php

										}
									}
									$c++;
								}
								if ($c < 5) {
									for ($m = $c; $m < 5; $m++) {
										?>
										<td style="width:13.37rem; border:3px solid black; /* border-radius: 15px; */ margin-right: 7px; margin-bottom: 7px; color:white;">&emsp;<?php echo "No Videos Right Now"; ?></td>
									<?php
									}
								} else {
									//$c=6;
									$k = 272 * $c;
									?>
									<script>
										var tab = document.getElementById("tab");
										// tab.style.width="<?php echo $k;  ?>px"
									</script>
								<?php
								}
								?>
							</tr>
				<?php $p++;
						}
					}
				}
				?>
			</tbody>
		</table>
		<?php
		if ($vid_cat == "") {
		} else {

			$this->db->where('id', $vid_cat);
			$cats = $this->db->get('videos')->result_array();
			//print_r($cats);
			$cat_id = $cats[0]['category_id'];
		?>
			<script>
				//document.getElementById("x").scrollIntoView(true);
				document.getElementById("xxx").scrollIntoView(true);
				//document.getElementById("categ<?php echo $cat_id; ?>").style.border="4px solid red";
				// window.location.href='categ<?php echo $cat_id; ?>';
			</script>
		<?php } ?>
	</div>



	<script>
		// // console.log(minutesLeftArray);
		const energyIcon = document.querySelector('.energyIcon');
		const verticalLine = document.querySelector('.verticalLine');

		let energyIconLeft = energyIcon.style.left;
		let verticalLineLeft = verticalLine.style.left;

		verticalLineLeft = Number(verticalLineLeft.split("rem")[0]);
		energyIconLeft = Number(energyIconLeft.split("rem")[0]);
		// // console.log(energyIconLeft, verticalLineLeft);
		let firstVideoDivWidth = 13.37;
		let timeOutToMoveLeft;
		let moveLeft;
		if (((minutesLeftArray[0].min_left * 60) / 50) < 13.37) {
			firstVideoDivWidth = 13.37;
			moveLeft = firstVideoDivWidth / 1000;
			timeOutToMoveLeft = minutesLeftArray[0].min_left * 60;
		} else {
			firstVideoDivWidth = (minutesLeftArray[0].min_left * 60) / 50;
			moveLeft = firstVideoDivWidth / 1000;
			timeOutToMoveLeft = minutesLeftArray[0].min_left * 60;
		}

		// // console.log(moveLeft + energyIconLeft + 'rem');

		function changeIconAndVerticalLinePosition() {
			var currentVideoPlayingTDWidth = $(`#videoID${current_playing_video_id}`).width();
			// console.log(currentVideoPlayingTDWidth / 13.60);
			var energyIconPosition = $('#energyIcon').position();
			var currentPlayingVideoPosition = $(`#videoID${current_playing_video_id}`).position();
			// console.log(secondsPassedPlayingTheVideo, secondsPassedPlayingTheVideo);
			document.getElementById('energyIcon').style.left = (currentPlayingVideoPosition.left - 9) + (secondsPassedPlayingTheVideo) + 'px';
			document.getElementById('verticalLine').style.left = (currentPlayingVideoPosition.left + 1) + (secondsPassedPlayingTheVideo) + 'px';

			document.getElementById(`videoID${previous_playing_video_id}`).style.backgroundColor = '';
			document.getElementById(`videoID${current_playing_video_id}`).style.backgroundColor = '#034281';

			energyIconLeft = moveLeft + energyIconLeft;
			verticalLineLeft = moveLeft + verticalLineLeft;
			if (firstVideoDivWidth == 13.37) {
				// document.getElementById('energyIcon').style.left = energyIconLeft + 'rem';
				// document.getElementById('verticalLine').style.left = verticalLineLeft + 'rem';
				setTimeout(changeIconAndVerticalLinePosition, timeOutToMoveLeft);
			} else {
				// document.getElementById('energyIcon').style.left = energyIconLeft + 'rem';
				// document.getElementById('verticalLine').style.left = verticalLineLeft + 'rem';
				setTimeout(changeIconAndVerticalLinePosition, timeOutToMoveLeft);

			}
		}

		function oneMinutePassed() {
			minutesLeftArray.forEach(minutesLeftElement => {
				if (minutesLeftElement.min_left >= 0) {
					$(`#minutesLeftChanged${minutesLeftElement.video_id}`).html('&nbsp;' + minutesLeftElement.min_left);
					minutesLeftElement.min_left = minutesLeftElement.min_left - 1;
				}


			})





			setTimeout(oneMinutePassed, 60000);
		}
		oneMinutePassed();
		changeIconAndVerticalLinePosition();
	</script>

</body>

</html>
