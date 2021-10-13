function DrawWorm(){
		
	this.initialize = function(){
			
		width = window.innerWidth;
		height = window.innerHeight;
		
		canvas.width = width;
		canvas.height = height;
	}			
}
    
//Hacked up matrix, borrowed from easel.js -- thanks grant!
//
// -- If you are forking this, then you will want to play with the code above this line.
// -- Unless you are totally nuts!
//
(function(window) {


var Matrix2D = function(a, b, c, d, tx, ty) {
  this.initialize(a, b, c, d, tx, ty);
}
var p = Matrix2D.prototype;

	p.initialize = function(a, b, c, d, tx, ty) {
		if (a != null) { this.a = a; }
		this.b = b || 0;
		this.c = c || 0;
		if (d != null) { this.d = d; }
		this.tx = tx || 0;
		this.ty = ty || 0;
	}

	// this has to be populated after the class is defined:
	Matrix2D.identity = new Matrix2D(1, 0, 0, 1, 0, 0);
	
}(window));    

// var app, interval, count;

setTimeout( function() {
  app = new DrawWorm();
  app.initialize();
  count = 0;
  interval = setInterval( demoApp, 20 );
}, 10);