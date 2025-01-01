// Mouse movement tilt effect
function tilt(event) {
    const tiltBox = event.currentTarget;
    const rect = tiltBox.getBoundingClientRect();
    const offsetX = event.clientX - rect.left;
    const offsetY = event.clientY - rect.top;
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
  
    const deltaX = (offsetX - centerX) / centerX;
    const deltaY = (offsetY - centerY) / centerY;
  
    const tiltX = deltaY * 10;
    const tiltY = -deltaX * 10;
  
    tiltBox.style.transform = `rotateX(${tiltX}deg) rotateY(${tiltY}deg)`;
  }
  