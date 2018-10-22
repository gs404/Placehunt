<?php 

require_once('sidenav.php');
require_once('../includes/companyfunctions.php');

session_start();
if(!isset($_SESSION['name'])){
	header('location: ../index.php');
}	


?>
<style>
		/*form styles*/
		#msform {
			width: 400px;
			margin: 50px auto;
			text-align: center;
			position: relative;
		}
		#msform fieldset {
			background: white;
			border: 0 none;
			border-radius: 5px;
			box-shadow: 0 0 2px 2px rgba(50, 50, 50);
			padding: 20px 30px;
			box-sizing: border-box;
			width: 80%;
			margin: 0 10%;
			
			/*stacking fieldsets above each other*/
			position: relative;
		}
		/*Hide all except first fieldset*/
		#msform fieldset:not(:first-of-type) {
			display: none;
		}
		/*inputs*/
		#msform input, #msform textarea {
			padding: 15px;
			border: none;
			border-bottom: 1px solid rgba(50, 50, 50);
			border-radius: 10px;
			margin-bottom: 10px;
			width: 100%;
			box-sizing: border-box;
			font-family: montserrat;
			color: #2C3E50;
			font-size: 15px;
			-webkit-transition: all 0.7s ease-in-out;
		    transition: all 0.7s ease-in-out;
		}
		#msform input:focus,
		#msform select:focus,
		#msform textarea:focus,
		#msform button:focus {
		    outline: none;
		}
		#msform input[type=text]:focus {
			border: 1px solid black;
			transform: translateY(-10px);
		    box-shadow: 3px 2px 3px black;
		}
		#msform textarea:focus {
			border: 1px solid black;
		    box-shadow: 0px 4px 2px black;
		}
		/*buttons*/
		#msform .action-button {
			width: 100px;
			background: rgb(66, 134, 244);
			font-weight: bold;
			color: white;
			border: 0 none;
			border-radius: 1px;
			cursor: pointer;
			padding: 10px 5px;
			margin: 10px 5px;
		}
		#msform .action-button:hover, #msform .action-button:focus {
			box-shadow: 0 0 0 2px white, 0 0 0 3px rgb(31, 73, 142);
		}
		/*headings*/
		.fs-title {
			font-size: 15px;
			text-transform: uppercase;
			color: #2C3E50;
			margin-bottom: 10px;
		}
		.fs-subtitle {
			font-weight: normal;
			font-size: 13px;
			color: #666;
			margin-bottom: 20px;
		}
		/*progressbar*/
		#progressbar {
			margin-bottom: 30px;
			overflow: hidden;
			/*CSS counters to number the steps*/
			counter-reset: step;
		}
		#progressbar li {
			list-style-type: none;
			color: white;
			text-transform: uppercase;
			font-size: 13px;
			width: 33.33%;
			float: left;
			position: relative;
		}
		#progressbar li:before {
			content: counter(step);
			counter-increment: step;
			width: 50px;
			line-height: 50px;
			display: block;
			font-size: 20px;
			color: #333;
			background: white;
			border-radius: 50%;
			margin: 0 auto 5px auto;
		}
		/*progressbar connectors*/
		#progressbar li:after {
			content: '';
			width: 100%;
			height: 2px;
			background: white;
			position: absolute;
			left: -50%;
			top: 9px;
			z-index: -1; /*put it behind the numbers*/
		}
		#progressbar li:first-child:after {
			/*connector not needed before the first step*/
			content: none; 
		}
		/*marking active/completed steps green*/
		/*The number of the step and the connector before it = green*/
		#progressbar li.active:before,  #progressbar li.active:after{
			background: rgba(58, 15, 188);
			color: white;
		}
		/* -------------- reset.css -------------- */
		html, body, div, span, h1, h2, h3, h4, h5, h6, p, em, img, strong, sub, sup, b, u, i, dl, dt, dd, ol, ul, li, fieldset, form, label, table, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video {
		  margin: 0;
		  padding: 0;
		  border: 0;
		  outline: 0;
		  vertical-align: baseline;
		  background: transparent;
		  font-size: 100%;
		}
		

		html {
		  overflow-y: scroll;
		}
		body {
		  line-height: 1.2;
		}

		.clearfix:after {
		  content: ".";
		  display: block;
		  height: 0;
		  clear: both;
		  visibility: hidden;
		}
		.clearfix {
		  display: inline-block;
		}
		/*_\*/
		* html .clearfix {
		  height: 1%;
		}
		.clearfix {
		  display: block;
		}

		html, body {
		  height: 100%;
		}

		.js-ag-blurlayer {
		  z-index: -1;
		  position: absolute;
		  left: 0;
		  top: 0;
		}

		.ag-dark-blur {
		  width: 100%;
		  height: 100%;
		  background-image: url(https://raw.githubusercontent.com/SochavaAG/example-mycode/master/pens/dark-blur/images/dark-blur.jpg);
		  background-color: #3f4652;
		  background-size: cover;

		  z-index: -1;
		  position: absolute;
		  top: 0;
		  left: 0;
		}
		</style>

	<div class="main-content">
			<div class="title">
				Upload Jobs
			</div>
			<div class="main">
				<!-- multistep form -->
				<form id="msform" action="processjob.php" method="POST">
				  <!-- progressbar -->
				  <ul id="progressbar">
				    <li class="active">Job Specification</li>
				    <li>Requirements</li>
				    <li>Package Details</li>
				  </ul>
				  <!-- fieldsets -->
				  <fieldset>
				    <h2 class="fs-title">Job Details</h2>
				    <h3 class="fs-subtitle">Add Job title and description</h3>
				    <hr><br>
				    <input type="text" name="title" placeholder="Title" />
				    <textarea name="description" placeholder="Description" style="height: 120px;"></textarea>
				    <input type="button" name="next" class="next action-button" value="Next" />
				  </fieldset>
				  <fieldset>
				    <h2 class="fs-title">SkillSet</h2>
				    <h3 class="fs-subtitle">Your Criteria</h3>
				    <hr><br>
				    <input type="text" name="cgpa" placeholder="CGPA criterion" />
				    <textarea name="skills" placeholder="Skills Expected (example:Django,Laravel,Html,CSS etc)" style="height: 150px;"></textarea>
				    <input type="button" name="next" class="next action-button" value="Next" />
				  </fieldset>
				  <fieldset>
				    <h2 class="fs-title">Package Offering</h2>
				    <h3 class="fs-subtitle">Range of Offering</h3>
				    <hr><br>
				    <input type="text" name="package" placeholder="" />
				    <input type="submit" name="submit" class="submit action-button" value="Submit" />
				  </fieldset>
				</form>
				<div class="ag-dark-blur"></div>
				<script type="text/javascript">
					(function ($) {
					  $(function () {

					    (function() {
					      var x=new r;
					      function r(){}
					      r.prototype.setInterval=function(a,b){
					        return window.setInterval(a,b)
					      }

					      r.prototype.clearInterval=function(a){
					        window.clearInterval(a)
					      }

					      r.prototype.setTimeout=function(a,b){
					        return window.setTimeout(a,b)
					      }

					      r.prototype.clearTimeout=function(a){
					        window.clearTimeout(a)
					      }

					      r.prototype.requestAnimationFrame=function(a){
					        return window.requestAnimationFrame(a)
					      }

					      r.prototype.cancelAnimationFrame=function(a){
					        window.cancelAnimationFrame(a)
					      }

					      function y(){
					        var a=$("body");
					        function b(){
					          a.mousemove(function(c){
					            p=c.clientX;
					            t=c.clientY;
					            w=Date.now();
					            u||n()
					          });

					          $(window).on("blur mouseout",function(){
					            t=p=null
					          })
					            .on("resize",function(){
					              d&&d.parentNode&&d.parentNode.removeChild(d);
					              q()
					            });
					          q()
					        }

					        function q(){
					          var c,b;
					          h();
					          c=a.width();
					          b=a.height();
					          d=document.createElement("canvas");
					          d.className="js-ag-blurlayer";
					          d.width=c;
					          d.height=b;
					          a.append(d);
					          l=document.createElement("canvas");
					          l.width=c;
					          l.height=b;
					          if(d.getContext&&d.getContext("2d")&&(m=d.getContext("2d"),
					              f=l.getContext("2d"),
					              f.lineCap="round",
					              f.shadowColor="#000000",
					              f.shadowBlur=-1<navigator.userAgent.indexOf("Firefox")?0:30,!g)){
					            g=new Image();
					            if(!a.css("background-image")) throw Error("element must have a background image");
					            $(g).one("load",n);
					            // imagem clara
					            $(g).attr("src","https://raw.githubusercontent.com/SochavaAG/example-mycode/master/pens/dark-blur/images/default-bg.jpg");
					          }
					        }

					        function h(){
					          v=[];
					          $(".js-blurEffect--skip").each(function(c,a){
					            var d;
					            d=$(a);
					            d.is(":visible")&&(c=d.position(),
					                a=d.outerWidth(),
					                d=d.outerHeight(),
					                v.push({
					                  top:c.top,
					                  left:c.left,
					                  width:a,
					                  height:d
					                })
					            )}
					          )}

					        function n(){
					          var c, b=Date.now();
					          c=a.scrollTop();
					          u=b>w+500?!1:!0;
					          p&&u&&e.unshift({
					            time:b,x:p,y:t+c
					          });
					          for(c=0;c<e.length;)
					            1E3<b-e[c].time?e.length=c:c++;
					          0<e.length&&x.requestAnimationFrame(n);
					          f.clearRect(0,0,l.width,l.height);
					          for(c=1;c<e.length;c++){
					            var h=Math.sqrt(Math.pow(e[c].x-e[c-1].x,2)+Math.pow(e[c].y-e[c-1].y,2));
					            f.strokeStyle="rgba(0,0,0,"+Math.max(1-(b-e[c].time)/1E3,0)+")";
					            f.lineWidth=25+75*Math.max(1-h/50,0);
					            f.beginPath();
					            f.moveTo(e[c-1].x,e[c-1].y);
					            f.lineTo(e[c].x,e[c].y);
					            f.stroke()
					          }
					          b=d.width;
					          c=d.width/g.naturalWidth*g.naturalHeight;
					          c<d.height&&(c=d.height,b=d.height/g.naturalHeight*g.naturalWidth);
					          m.drawImage(g,0,0,b,c);
					          m.globalCompositeOperation="destination-in";
					          m.drawImage(l,0,0);
					          m.globalCompositeOperation="source-over";
					          v.forEach(function(c){
					            m.clearRect(c.left,c.top,c.width,c.height)
					          })
					        }
					        var d,l,m,f,g,p=null,t=null,e=[],w=0,u=!0,v=[];
					        "createTouch" in document||$(b)
					      }

					      $(function(){
					        y()
					      });
					    })();

					  });
					})(jQuery);
				</script>
			</div>
		</div>

		<script type="text/javascript">
			
			//jQuery time
			var current_fs, next_fs, previous_fs; //fieldsets
			var left, opacity, scale; //fieldset properties which we will animate
			var animating; //flag to prevent quick multi-click glitches

			$(".next").click(function(){
				if(animating) return false;
				animating = true;
				
				current_fs = $(this).parent();
				next_fs = $(this).parent().next();
				
				//activate next step on progressbar using the index of next_fs
				$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
				
				//show the next fieldset
				next_fs.show(); 
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now, mx) {
						//as the opacity of current_fs reduces to 0 - stored in "now"
						//1. scale current_fs down to 80%
						scale = 1 - (1 - now) * 0.2;
						//2. bring next_fs from the right(50%)
						left = (now * 50)+"%";
						//3. increase opacity of next_fs to 1 as it moves in
						opacity = 1 - now;
						current_fs.css({
			        'transform': 'scale('+scale+')',
			        'position': 'absolute'
			      });
						next_fs.css({'left': left, 'opacity': opacity});
					}, 
					duration: 800, 
					complete: function(){
						current_fs.hide();
						animating = false;
					}, 
					//this comes from the custom easing plugin
					easing: 'easeInOutBack'
				});
			});

			$(".previous").click(function(){
				if(animating) return false;
				animating = true;
				
				current_fs = $(this).parent();
				previous_fs = $(this).parent().prev();
				
				//de-activate current step on progressbar
				$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
				
				//show the previous fieldset
				previous_fs.show(); 
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now, mx) {
						//as the opacity of current_fs reduces to 0 - stored in "now"
						//1. scale previous_fs from 80% to 100%
						scale = 0.8 + (1 - now) * 0.2;
						//2. take current_fs to the right(50%) - from 0%
						left = ((1-now) * 50)+"%";
						//3. increase opacity of previous_fs to 1 as it moves in
						opacity = 1 - now;
						current_fs.css({'left': left});
						previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
					}, 
					duration: 800, 
					complete: function(){
						current_fs.hide();
						animating = false;
					}, 
					//this comes from the custom easing plugin
					easing: 'easeInOutBack'
				});
			});

			$(".submit").click(function(){
				return false;
			})
		</script>
	</body>
</html>