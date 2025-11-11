function attachDesc(targetId,addDesc){
let target=document.getElementById(targetId);

const createabout=document.createElement("div");
createabout.classList.add("description");

createabout.textContent=addDesc;

target.insertAdjacentElement("afterend",createabout);


target.addEventListener("mouseover",()=>{
    createabout.classList.add("show");
});


target.addEventListener("mouseleave",()=>{
    createabout.classList.remove("show");
});



}




attachDesc("about1","SWASTHYA is an online medical appointment system which allows patients to book appointment, store medical reports digitally and can be accessed anywhere, anytime.");
attachDesc("about2","You can book an appointment by sign-up/login in the platform then selecting department, hospital and confirming the booking.");
attachDesc("about3","SWASTHYA provides features like department, doctor and hospital search, online booking, appointment management, record medical records digitally.");
attachDesc("about4","You can cancel your appointment from the “My Appointments” section by selecting the booking and choosing the cancel option.");
attachDesc("about5","Payments should be done through physical visit");
attachDesc("about6","Yes, SWASTHYA ensures data privacy and secure transactions, protecting both patient and doctor information with encryption and safety protocols.");
