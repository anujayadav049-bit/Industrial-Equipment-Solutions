// 1. PAGE LOAD - HAMESHA TOP SE
if (history.scrollRestoration) { history.scrollRestoration = 'manual'; }
window.addEventListener('load', () => {
  window.scrollTo(0, 0);
  setTimeout(() => {
    window.scrollTo(0, 0);
    if(window.ScrollTrigger) ScrollTrigger.refresh();
  }, 100);
});
window.onbeforeunload = function() { window.scrollTo(0, 0); };
if(window.gsap) gsap.registerPlugin(ScrollTrigger);

// 2. WHATSAPP POPUP - Jo index.html me tha
document.addEventListener('DOMContentLoaded', () => {
  const waBtn = document.getElementById('wa-btn');
  const waBox = document.getElementById('wa-box');
  const waCloseTop = document.getElementById('wa-close-top');
  const waCloseBottom = document.getElementById('wa-close-bottom');
  if(waBtn && waBox){
    function openWA(){ waBox.style.display='block'; waBtn.style.display='none'; waCloseBottom.style.display='flex'; }
    function closeWA(){ waBox.style.display='none'; waBtn.style.display='flex'; waCloseBottom.style.display='none'; }
    waBtn.onclick = openWA;
    if(waCloseTop) waCloseTop.onclick = closeWA;
    if(waCloseBottom) waCloseBottom.onclick = closeWA;
  }

  // 3. QUOTE FORM - Jo index.html me tha
  const quoteForm = document.getElementById("quoteForm");
  if(quoteForm){
    quoteForm.addEventListener("submit", function(e){
      e.preventDefault();
      var formData = new FormData(this);
      fetch("contact_save.php", { method: "POST", body: formData })
     .then(res => res.text()).then(data => {
        const msg = document.getElementById("formMsg");
        if(msg) msg.style.display = "block";
        quoteForm.reset();
        setTimeout(()=>{ if(msg) msg.style.display="none"; }, 4000);
      });
    });
  }
});

// 4. MOBILE MENU - FINAL FIX
function toggleMenu() {
  const menu = document.getElementById("mobileMenu");
  const btn = document.getElementById("hamburgerBtn");
  const icon = btn? btn.querySelector('i') : null;
  if(!menu) return;
  menu.classList.toggle("active");
  if(menu.classList.contains("active")){
    if(icon) icon.className = "fa-solid fa-xmark";
    if(btn){ btn.style.position = "fixed"; btn.style.right = "20px"; btn.style.top = "20px"; }
  } else {
    if(icon) icon.className = "fa-solid fa-bars";
    if(btn){ btn.style.position = "relative"; btn.style.right = "auto"; btn.style.top = "auto"; }
    const sub = document.getElementById("submenu");
    if(sub) sub.classList.remove("show");
    const subIcon = document.querySelector(".has-sub i");
    if(subIcon) subIcon.style.transform = "rotate(0deg)";
  }
}
function openSub(e) {
  e.preventDefault(); e.stopPropagation();
  const sub = document.getElementById("submenu");
  if(!sub) return false;
  sub.classList.toggle("show");
  const icon = e.currentTarget? e.currentTarget.querySelector('i') : null;
  if(icon) icon.style.transform = sub.classList.contains("show")? "rotate(180deg)" : "rotate(0deg)";
  return false;
}

// 5. FAQ
function toggleFaq(el){
  const item = el.parentElement;
  const allItems = document.querySelectorAll('.faq-item');
  if(item.classList.contains('active')) item.classList.remove('active');
  else { allItems.forEach(i => i.classList.remove('active')); item.classList.add('active'); }
}

// 6. SCROLL REVEAL
const revealObserver = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{ if(entry.isIntersecting){ entry.target.classList.add('show'); revealObserver.unobserve(entry.target); } });
},{threshold:0.05, rootMargin: "0px 0px -50px 0px"});
document.addEventListener('DOMContentLoaded',()=>{
  document.querySelectorAll('.service-card,.product,.about-image,.why,.faq-item').forEach(el=>{
    el.classList.add('reveal'); revealObserver.observe(el);
  });
});

// 7. SWIPER - Jo index.html me tha
document.addEventListener('DOMContentLoaded', () => {
  if(window.Swiper){
    new Swiper(".mySwiper", {
      slidesPerView: 3, spaceBetween: 20, loop: true,
      autoplay: { delay: 3000, disableOnInteraction: false },
      pagination: { el: ".swiper-pagination", clickable: true },
      breakpoints: { 0: { slidesPerView: 1 }, 640: { slidesPerView: 1 }, 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } },
    });
  }
});

// 8. GSAP ANIMATIONS
if(window.gsap){
  gsap.from("h1", { y: 30, opacity: 0, duration: 0.8, clearProps: "all" });
  const cursor = document.querySelector(".cursor");
  if(cursor){
    gsap.set(cursor, { xPercent: -50, yPercent: -50 });
    window.addEventListener("mousemove", (e) => {
      gsap.to(cursor, { x: e.clientX, y: e.clientY, duration: 0.5, ease: "power3.out", rotation: "+=10" });
    });
    document.querySelectorAll("a, button").forEach(el => {
      el.addEventListener("mouseenter", () => { gsap.to(cursor, { scale: 1.5, duration: 0.3 }); });
      el.addEventListener("mouseleave", () => { gsap.to(cursor, { scale: 1, duration: 0.3 }); });
    });
  }
  if(document.querySelector(".stat-number")){
    gsap.utils.toArray(".stat-number").forEach(num => {
      let target = num.getAttribute("data-target");
      gsap.fromTo(num, { innerText: 0 }, {
        innerText: target, duration: 2, snap: { innerText: 1 },
        scrollTrigger: { trigger: "#stats", start: "top 80%", once: true },
        onUpdate: function() { this.targets()[0].innerHTML = Math.ceil(this.targets()[0].innerText) + "+"; }
      });
    });
  }
}

// 9. H1, H2, P KO UPAR SE LAANA - jo tum puch rahi thi
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll("h1, h2, p, a").forEach((el, i) => {
    el.style.animation = `uparAao 0.6s ease-out ${i * 0.02}s both`;
  });
});

