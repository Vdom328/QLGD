// Variables to track the initial click position and modal position
var clickX, clickY;
var modalX, modalY;

// Function to initialize the mouse tracking
function initMouseTracking() {
  // Track the mousedown event on the modal header
  $('.modal-header').mousedown(function(e) {
    clickX = e.pageX;
    clickY = e.pageY;
    modalX = $('.modal').offset().left;
    modalY = $('.modal').offset().top;
    
    // Track the mousemove event on the document
    $(document).mousemove(function(e) {
      var moveX = modalX + e.pageX - clickX;
      var moveY = modalY + e.pageY - clickY;
      
      // Update the modal position
      $('.modal').css({
        'top': moveY + 'px',
        'left': moveX + 'px'
      });
    });
  });

  // Track the mouseup event on the document
  $(document).mouseup(function() {
    // Stop tracking the mousemove event
    $(document).off('mousemove');
  });
}

// Call the initMouseTracking function to start tracking the mouse events
initMouseTracking();