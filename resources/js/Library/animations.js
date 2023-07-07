import {onMounted, onUnmounted} from 'vue';

export const animateMousePerspective = (gsap, elRef) => {
  return {
    mouse: {x: 0, y: 0},
    screenCenter: {x: 0, y: 0},
    frameRequest: null,
    mouseMove: function (event) {
      this.mouse.x = event.pageX;
      this.mouse.y = event.pageY;

      cancelAnimationFrame(this.frameRequest);

      this.frameRequest = requestAnimationFrame(this.update.bind(this));
    },
    setScreenCenter: function () {
      this.screenCenter.x = window.innerWidth / 2;
      this.screenCenter.y = window.innerHeight / 2;
    },
    update: function () {
      const dx = this.mouse.x - this.screenCenter.x;
      const dy = this.mouse.y - this.screenCenter.y;

      const tiltx = -dy / this.screenCenter.y;
      const tilty = dx / this.screenCenter.x;
      const radius = Math.sqrt(Math.pow(tiltx, 2) + Math.pow(tilty, 2));
      const degree = radius * 20;

      gsap.to(elRef.value, {
        transform: `rotate3d(${tiltx}, ${tilty}, 0, ${degree}deg) perspective(1000px)`,
        ease: 'power2.out'
      });
    },
    addEventListeners: function () {
      window.addEventListener('mousemove', this.mouseMove);
      window.addEventListener('resize', this.setScreenCenter);
    },
    removeEventListeners: function () {
      window.removeEventListener('mousemove', this.mouseMove);
      window.removeEventListener('resize', this.setScreenCenter);
    },
    init: function () {
      this.mouseMove = this.mouseMove.bind(this);
      this.setScreenCenter = this.setScreenCenter.bind(this);

      this.setScreenCenter();

      onMounted(this.addEventListeners.bind(this));
      onUnmounted(this.removeEventListeners.bind(this));
    }
  };
};
