<?php  
/*
Template Name: test
*/
?>
<?php get_header(); ?>
<style>
    .col-md-1-2{
      display: flex;
      max-width: 920px;
      justify-content: center;
      flex-direction: column;
      align-items: center;
      margin: 0 auto;
    }
    #myCanvas1{
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>


<div style="height:2000px;">
</div>
		<section id="blocks-pc">
  <div class="container">
    <div class="row">
      <div class="col-md-1-1">
		  <div class="block-content2">
			  <div class="trih-zag">
			  <p class="trih-num">2.</p>
			  </div>
			  <div>
			  <h4 class="trih-h4"><?php the_field('2_yakmi'); ?></h4>
    		<p class="trih-p2"><?php the_field('2_yakmi_opis'); ?></p>
				   </div>
  </div>
		  <div class="block-content4">
			  <div class="trih-zag">
			  <p class="trih-num">4.</p>
			  </div>
			  <div>
			  <h4 class="trih-h4"><?php the_field('4_yakmi'); ?></h4>
    		<p class="trih-p2"><?php the_field('4_yakmi_opis'); ?></p>
				   </div>
  </div>
      </div>
		<div class="col-md-1-2">
   <canvas id="myCanvas1" width="300" height="1000"></canvas>
  </div>
      <div class="col-md-1-1">
        <div class="block-content1">
			  <div class="trih-zag">
			  <p class="trih-num">1.</p>
			  </div>
			  <div>
			  <h4 class="trih-h4"><?php the_field('1_yakmi'); ?></h4>
    		<p class="trih-p2"><?php the_field('1_yakmi_opis'); ?></p>
				   </div>
  </div>
		  <div class="block-content3">
			  <div class="trih-zag">
			  <p class="trih-num">3.</p>
			  </div>
			  <div>
			  <h4 class="trih-h4"><?php the_field('3_yakmi'); ?></h4>
    		<p class="trih-p2"><?php the_field('3_yakmi_opis'); ?></p>
				   </div>
  </div>
		  <div class="block-content5">
			  <div class="trih-zag">
			  <p class="trih-num">5.</p>
			  </div>
			  <div>
			  <h4 class="trih-h4"><?php the_field('5_yakmi'); ?></h4>
    		<p class="trih-p2"><?php the_field('5_yakmi_opis'); ?></p>
				   </div>
  </div>
  </div>
		 </div> </div></section>
  <div style="height:2000px;">
</div>
<script>
const drawImageOnPath = (ctx, img, path, imgWidth, imgHeight) => {
  const tempSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  const tempPath = tempSvg.appendChild(document.createElementNS("http://www.w3.org/2000/svg", "path"));
  tempPath.setAttribute("d", path);
  const pathLength = tempPath.getTotalLength();
  let t = 0;

  const moveImage = () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.beginPath();
    ctx.setLineDash([10, 10]);
    ctx.strokeStyle = "#181818";
    ctx.stroke(new Path2D(tempPath.getAttribute('d')));

    const point = tempPath.getPointAtLength(t > pathLength ? pathLength : t);
    const x = point.x - imgWidth / 2;
    const y = point.y - imgHeight / 2;
    const offsetY = 17;
    ctx.drawImage(img, x, y + offsetY, imgWidth, imgHeight);
  };

  moveImage();

  const handleScroll = () => {
    const canvasRect = canvas.getBoundingClientRect();
    const canvasTopOffset = canvasRect.top + window.scrollY;
    const canvasHeight = canvasRect.height;
    const scrollPercentage = (window.scrollY - canvasTopOffset) / (canvasHeight - window.innerHeight);
    t = scrollPercentage * pathLength;
    moveImage();
  };

  window.addEventListener('scroll', handleScroll);
};

const canvas = document.getElementById("myCanvas1");
const ctx = canvas.getContext("2d");

ctx.lineWidth = 2;
ctx.strokeStyle = "#181818";

const path = "M105.257 1C104.881 15.4297 100.8226 50.1366 116.909 67.6653C127.047 78.713 144.272 102.008 116.909 115.861C96.831 126.025 59.0258 150.203 92.1018 202.15C113.3685 235.551 149.834 319.493 92.1018 398.683C76.1902 415.325 39.0299 436.835 17.68089 389.737C14.67168 378.289 15.29813 357.183 49.8775 364.34C73.3821 369.205 104.9039 402.319 123.547 465.349C133.922 500.428 169.681 584.497 99.2432 643.7C99.2432 643.7 24.50607 697.834 123.547 780.205C143.735 797.167 140.212 823.263 95.1087 874.287C78.696 892.084 59.4663 936.589 103.7535 978.758";

const beeImage = new Image();
beeImage.src = "/wp-content/uploads/2023/04/bjolam2.webp";
beeImage.onload = () => {
  const imgWidth = 50;
  const imgHeight = 50;
  drawImageOnPath(ctx, beeImage, path, imgWidth, imgHeight);
};
</script>

