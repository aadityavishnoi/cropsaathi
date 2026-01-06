/* PAGE SWITCH */
function showPage(id) {
  document.querySelectorAll(".page")
    .forEach(p => p.classList.remove("active"));
  document.getElementById(id).classList.add("active");
}

/* ROLE SWITCH */
let currentRole = "farmer";

function switchRole() {
  currentRole = document.getElementById("roleSelect").value;

  document.querySelectorAll(".sidebar button").forEach(btn => {
    btn.style.display =
      btn.dataset.role === currentRole ? "flex" : "none";
  });

  showPage(currentRole === "farmer" ? "dashboard" : "emandi");
}

switchRole();

/* DASHBOARD DATA */
fetch("backend/get_dashboard.php")
  .then(r => r.json())
  .then(d => {
    temp.innerText = d.temperature;
    humidity.innerText = d.humidity;
    soil.innerText = d.soil;
    ndvi.innerText = d.ndvi;
    alert.innerText = "⚠️ " + d.alert;
  });

/* E-MANDI */
fetch("backend/get_emandi.php")
  .then(r => r.json())
  .then(c => {
    cropCard.innerHTML = `
      <b>फसल:</b> ${c.name}<br>
      <b>मात्रा:</b> ${c.quantity}<br>
      <b>मांग:</b> ${c.price}<br>
      <b>स्थान:</b> ${c.location}<br><br>
      <button onclick="showPage('bids')">View Bids</button>
    `;
  });

/* BIDS */
fetch("backend/get_bids.php")
  .then(r => r.json())
  .then(b => {
    bidsCard.innerHTML = `
      <b>Buyer:</b> ${b[0].buyer}<br>
      <b>Bid:</b> ${b[0].price}<br>
      <b>Quantity:</b> ${b[0].quantity}<br><br>
      <button onclick="acceptBid(${b[0].id})">Accept Bid</button>
    `;
  });

function acceptBid(id) {
  fetch("backend/accept_bid.php", {
    method:"POST",
    headers:{ "Content-Type":"application/x-www-form-urlencoded" },
    body:"id="+id
  })
  .then(() => alert("✅ Order Created & Saved"));
}
