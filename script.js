// Refresh pe hamesha header se start
if (history.scrollRestoration) {
  history.scrollRestoration = 'manual';
}

// Page load hote hi top pe bhejo
window.addEventListener('load', () => {
  window.scrollTo(0, 0);
  setTimeout(() => {
    window.scrollTo(0, 0);
    ScrollTrigger.refresh(); // ye line  important hai
  }, 100);
});

window.onbeforeunload = function() {
  window.scrollTo(0, 0);
};

gsap.registerPlugin(ScrollTrigger);

function toggleMenu() {
  const menu = document.getElementById("mobileMenu");
  const btn = document.getElementById("hamburgerBtn").querySelector('i');
  menu.classList.toggle("active");
  
  if(menu.classList.contains("active")){
    btn.className = "fa-solid fa-xmark";
    btn.style.color = "#fff";
    document.getElementById("hamburgerBtn").style.position = "fixed";
    document.getElementById("hamburgerBtn").style.right = "20px";
    document.getElementById("hamburgerBtn").style.top = "20px";
  } else {
    btn.className = "fa-solid fa-bars";
    btn.style.color = "#000";
    document.getElementById("hamburgerBtn").style.position = "relative";
    document.getElementById("hamburgerBtn").style.right = "auto";
    document.getElementById("hamburgerBtn").style.top = "auto";
  }
}

function openSub(e) {
  if (window.innerWidth <= 900) {
    e.preventDefault();
    document.getElementById("submenu").classList.toggle("show");
  }
}

function toggleFaq(el){
  const item = el.parentElement;
  const allItems = document.querySelectorAll('.faq-item');
  if(item.classList.contains('active')){
    item.classList.remove('active');
  } else {
    allItems.forEach(i => i.classList.remove('active'));
    item.classList.add('active');
  }
}

// ===== YE HAI NAYA MICRO ANIMATION CODE - MOBILE FIX =====
const revealObserver = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      entry.target.classList.add('show');
      revealObserver.unobserve(entry.target);
    }
  });
},{threshold:0.05, rootMargin: "0px 0px -50px 0px"});

document.addEventListener('DOMContentLoaded',()=>{
  document.querySelectorAll('.service-card, .product, .about-image, .why, .faq-item').forEach(el=>{
    el.classList.add('reveal');
    revealObserver.observe(el);
  });
});

// --- Aapka purana code upar rehne do ---
// ... jo bhi pehle se likha hai ...

// --- Uske baad neeche ye naya GSAP wala code paste karo ---
gsap.registerPlugin(ScrollTrigger);

gsap.from("h1", {
  y: 30,
  opacity: 0,
  duration: 0.8,
  clearProps: "all"
});
















gsap.registerPlugin(ScrollTrigger);

// Mouse wala gol circle
const cursor = document.querySelector(".cursor");

gsap.set(cursor, { xPercent: -50, yPercent: -50 });

window.addEventListener("mousemove", (e) => {
  gsap.to(cursor, {
    x: e.clientX,
    y: e.clientY,
    duration: 0.5, // jitna kam, utna tez peeche aayega
    ease: "power3.out",
    rotation: "+=10", // ghumte hue aayega
  });
});

// Jab button par jao to circle bada ho jaye
document.querySelectorAll("a, button").forEach(el => {
  el.addEventListener("mouseenter", () => {
    gsap.to(cursor, { scale: 1.5, duration: 0.3 });
  });
  el.addEventListener("mouseleave", () => {
    gsap.to(cursor, { scale: 1, duration: 0.3 });
  });
});


// --- Number Counting - Sirf Add kiya hai ---
gsap.utils.toArray(".stat-number").forEach(num => {
  let target = num.getAttribute("data-target");
  gsap.fromTo(num, { innerText: 0 }, {
    innerText: target,
    duration: 2,
    snap: { innerText: 1 },
    scrollTrigger: { trigger: "#stats", start: "top 80%", once: true },
    onUpdate: function() {
      this.targets()[0].innerHTML = Math.ceil(this.targets()[0].innerText) + "+";
    }
  });
});

function toggleMenu(){document.getElementById('mobileMenu').classList.toggle('show')}
function openSub(e){e.preventDefault();document.getElementById('submenu').classList.toggle('show')}



// ===== MENU FIX - ADD AT BOTTOM ONLY =====
function toggleMenu(){
  var menu = document.getElementById("mobileMenu");
  var icon = document.querySelector("#hamburgerBtn i");
  menu.classList.toggle("active");
  if(menu.classList.contains("active")){
    icon.className = "fa-solid fa-xmark";
  } else {
    icon.className = "fa-solid fa-bars";
  }
}
function openSub(e){
  e.preventDefault();
  document.getElementById("submenu").classList.toggle("open");
}