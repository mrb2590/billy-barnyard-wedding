export class MousePerspectiveAnimation {
  constructor(gsap, elRef, containerId = null) {
    this.gsap = gsap;
    this.elRef = elRef;
    this.mouseX = 0;
    this.mouseY = 0;
    this.screenCenter = {x: 0, y: 0};
    this.frameRequest = null;
    this.container = containerId ? document.getElementById(containerId) : window;
    this.setScreenCenter();
  }

  mouseMove(event) {
    this.mouseX = event.pageX;
    this.mouseY = event.pageY;
    const instance = this;

    cancelAnimationFrame(this.frameRequest);

    this.frameRequest = requestAnimationFrame(function () {
      instance.update();
    });
  }

  setScreenCenter() {
    this.screenCenter.x = window.innerWidth / 2;
    this.screenCenter.y = window.innerHeight / 2;
  }

  update() {
    const dx = this.mouseX - this.screenCenter.x;
    const dy = this.mouseY - this.screenCenter.y;

    const tiltx = -dy / this.screenCenter.y;
    const tilty = dx / this.screenCenter.x;
    const radius = Math.sqrt(Math.pow(tiltx, 2) + Math.pow(tilty, 2));
    const degree = radius * 20;

    this.gsap.to(this.elRef.value, {
      transform: `rotate3d(${tiltx}, ${tilty}, 0, ${degree}deg) perspective(1000px)`,
      ease: 'power2.out'
    });
  }

  addEventListeners() {
    const instance = this;
    this.container.addEventListener('mousemove', function (event) {
      instance.mouseMove(event);
    });
    this.container.addEventListener('resize', this.setScreenCenter);
  }

  removeEventListeners() {
    const instance = this;
    this.container.removeEventListener('mousemove', function (event) {
      instance.mouseMove(event);
    });
    this.container.removeEventListener('resize', this.setScreenCenter);
  }
}
