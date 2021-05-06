var a, b, c;
var outputText;
var x1, x2, delta;

let d = document.getElementById('a');
let e = document.getElementById('b');
let f = document.getElementById('c'); 
calcBtn.addEventListener('click', calculate);
    function calculate() {
        
         let a = d.value;
         let b = e.value;
         let c = f.value;

         a = parseFloat(a);
         b = parseFloat(b);
         c = parseFloat(c);
               
        // validate a, b and c
        if (a == 0) {
            outputText = 'a không thể bằng 0';
        } else {
            // calculate the result using x = (-b +- sqrt(b^2 - 4ac)) / 2a
            delta = Math.pow(b, 2) - 4 * a * c;
            
            if (delta > 0) {
                x1 = (-b - Math.sqrt(delta)) / (2 * a);
                x2 = (-b + Math.sqrt(delta)) / (2 * a);
                outputText =  'Phương trình có hai nghiệm';
            }else if (delta == 0) {
                x1 = (-b) / (2*a);
                x2 = (-b) / (2*a);
            }else {
                outputText = 'Phương trình không có nghiệm';
            }
            
        }

        document.getElementById("output_text").innerHTML = outputText;
        document.getElementById("delta").innerHTML = delta;
        document.getElementById("x1").innerHTML = x1;
        document.getElementById("x2").innerHTML = x2; 

    }
     


