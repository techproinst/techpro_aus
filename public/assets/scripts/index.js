document.addEventListener("DOMContentLoaded", function () {
  const counters = document.querySelectorAll(".score h1");
  const speed = 100; // Adjust speed of counting

  const startCounting = (counter) => {
      const target = parseFloat(counter.getAttribute("data-target"));
      const isPercentage = counter.textContent.includes("%");
      const isDecimal = counter.textContent.includes("/");
      
      let count = 0;
      const increment = target / speed;

      const updateCount = () => {
          if (count < target) {
              count += increment;
              counter.textContent = isDecimal ? count.toFixed(1) : Math.floor(count) + (isPercentage ? "%" : "");
              setTimeout(updateCount, 20);
          } else {
              counter.textContent = target + (isPercentage ? "%" : "");
          }
      };

      updateCount();
  };

  const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
          if (entry.isIntersecting) {
              const counter = entry.target;
              counter.setAttribute("data-target", counter.textContent.replace(/[^0-9.]/g, ""));
              startCounting(counter);
              observer.unobserve(counter);
          }
      });
  }, { threshold: 1.0 });

  counters.forEach(counter => observer.observe(counter));
});