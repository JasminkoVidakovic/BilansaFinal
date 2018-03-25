var ul;
var liItems;
var imageNumber;
var imageWidth;
var prev, next;
var currentPostion = 0;
var currentImage = 0;

function init(){
	ul = document.getElementById('image_slider');
	liItems = ul.children;
	imageNumber = liItems.length;
	imageWidth = liItems[0].children[0].clientWidth;
	ul.style.width = parseInt(imageWidth * imageNumber) + 'px';
	prev = document.getElementById("prev");
	next = document.getElementById("next");
	generatePager(imageNumber);
	prev.onclick = function(){ onClickPrev();};
	next.onclick = function(){ onClickNext();};
}

function animate(opts){
	var start = new Date;
	var id = setInterval(function(){
		var timePassed = new Date - start;
		var progress = timePassed / opts.duration;
		if (progress > 1){
			progress = 1;
		}
		var delta = opts.delta(progress);
		opts.step(delta);
		if (progress == 1){
			clearInterval(id);
			opts.callback();
		}
	}, opts.delay || 17);
	
}

function slideTo(imageToGo){
	var direction;
	var numOfImageToGo = Math.abs(imageToGo - currentImage);

	direction = currentImage > imageToGo ? 1 : -1;
	currentPostion = -1 * currentImage * imageWidth;
	var opts = {
		duration:1000,
		delta:function(p){return p;},
		step:function(delta){
			ul.style.left = parseInt(currentPostion + direction * delta * imageWidth * numOfImageToGo) + 'px';
		},
		callback:function(){currentImage = imageToGo;}	
	};
	animate(opts);
}

function onClickPrev(){
	if (currentImage == 0){
		slideTo(imageNumber - 1);
	} 		
	else{
		slideTo(currentImage - 1);
	}		
}

function onClickNext(){
	if (currentImage == imageNumber - 1){
		slideTo(0);
	}		
	else{
		slideTo(currentImage + 1);   
	}		
}

function generatePager(imageNumber){	
	var pagerDiv = document.getElementById('thumbnails');
	for (i = 0; i < imageNumber; i++){
		var li = document.createElement('li');
		var div = document.createElement('div');
		div.style.backgroundImage = "url('slika" + parseInt(i+1) + "T.png')";
		thumbnails.appendChild(div);
		div.onclick = function(i){
			return function(){
				slideTo(i);
			}
		}(i);
	}	
}
window.onload = init;

function FullScreen(imgNo) {
	
	var elem1 = document.getElementById("slika" + parseInt(imgNo+1));
	
	if (elem1.requestFullscreen) 
	{
		elem1.requestFullscreen();
	} 
	else if (elem1.msRequestFullscreen) 
	{
		elem1.msRequestFullscreen();
    } 
	else if (elem1.mozRequestFullScreen) 
	{
		
		elem1.mozRequestFullScreen();
    } 
	else if (elem1.webkitRequestFullscreen) 
	{
		elem1.webkitRequestFullscreen();
	}
	
}