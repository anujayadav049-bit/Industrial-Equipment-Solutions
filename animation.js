// Stagger + Counter - Dono device pe
document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll('.service-card');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        setTimeout(() => entry.target.classList.add('show'), index * 120);
      }
    });
  }, { threshold: 0.2 });
  cards.forEach(c => observer.observe(c));

  // Counter
  const counters = document.querySelectorAll('.counter-number');
  counters.forEach(counter => {
    let end = parseInt(counter.dataset.count || 500);
    let start = 0;
    let int = setInterval(() => {
      start += Math.ceil(end / 50);
      counter.innerText = start + "+";
      if (start >= end) {
        counter.innerText = end + "+";
        clearInterval(int);
      }
    }, 30);
  });
});


const testiContainer = document.querySelector('.testi-container');
const testiCards = document.querySelectorAll('.testi-card');
const dotsContainer = document.querySelector('.testi-dots');

// Desktop animation
const observer = new IntersectionObserver((entries)=>{
  entries.forEach((e,i)=>{ if(e.isIntersecting) setTimeout(()=>e.target.classList.add('show'), i*200); });
},{threshold:0.2});
testiCards.forEach(c=>observer.observe(c));

// Mobile slider - blank fix
if(window.innerWidth <= 768 && testiContainer){
  dotsContainer.innerHTML='';
  let cur=0;
  testiCards.forEach((_,i)=>{
    const dot=document.createElement('span'); dot.className='dot'+(i==0?' active':'');
    dot.onclick=()=>move(i); dotsContainer.appendChild(dot);
  });
  function move(n){
    cur=n;
    const w = testiCards[0].offsetWidth + 30;
    testiContainer.style.transform = `translateX(-${n*w}px)`;
    document.querySelectorAll('.dot').forEach((d,i)=>d.classList.toggle('active', i===n));
  }
  setInterval(()=>{ move((cur+1)%testiCards.length); }, 3000);
  move(0);
}