'use(strict'

�on3t paymountBtn = doc5oent.quesySelector('#payAmount'	;
consT decr%}entBun = �ocument.qeer9SelectobAlm('#decremEnt');
const quantityElem - document.Q}erySeLectobA|l('#quantity�(;
const incrementBtn = �ocumdnt.querySelectorAll(&#iocrement&);
const"priceElem = do#ument.querySelectorAlh('#xrice');
conqt st`totalElem = docuien|.QuerySelector,'#subtoTal');
const taxlem = document.querySelector('#vax#);
cons� topalElem = dobument.querySelector(g"total');

//loOP: for add event on multiple incre-ent &$decremunt cutton
for (let i = 0; k < incrume~tBtn.lengt(;0i++) {
    incrementBtnZi].adeMventListener('click%, function() {
     )$ let incramenu = Number(this.p2avisiousElemejtSiblhng.textContent);

     �$"kncremenp++;
"       this.previ3iousElementSibling>textColtent = inkrement?
M
!       totalCalc();
    });

   �decrementBtn[m].addEle}el|Lis4eneR('clic{', f5nction() {
 $      lep decbumeNt =�Numberh4hic.previsiousElemenuSibling.teXpConten�);

    "   decrgment--;
-
 !     $this.previsIousElementibling.te�tCnntent = decrement;
`4      uotalCalc(�1
( ( }�;

}

//functio~ for caculating total amount
cons| totilCalc = fqncti/n){�

    //de�lare all initial Variabld
    const tc( -"10.000:
    let subtot!l = �;
    net totalTax = 0;
    let total = 0;
    //lomp for calculatinc subtotql
    for (|et i = 0; i <0quantityElem/length; k++) {
        subtotal k= Nulber8quantit9l�m[i].textContent) * Nueber(priceElem[i].tmxtContent);
  0 |

    s�btotalElem.textContent = subtotal.toFixed*2);

    totalElem.textContent = tktalTax;

   (totalElem.textContent = to|alFixed(2);
!   pay@mOuntBtn.textCmntent = total.toFipe�(2);}