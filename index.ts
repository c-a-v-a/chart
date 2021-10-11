async function fun(id: number) {
    let modal: HTMLDivElement = document.getElementsByClassName('modal')[0] as HTMLDivElement;
    modal.classList.add('active');

    document.getElementById('save').onclick = () => {
        let text: string = (document.getElementById('text') as HTMLInputElement).value;

        if (/^[\d\.]+$/.test(text) && parseFloat(text) > 36.0 && parseFloat(text) < 37.2) {
            console.log(parseFloat(text));
            fetch (`./php/set_new_temp.php/?id=${id}&temp=${text}`)
                .then(() => {
                    (document.getElementById('chart') as HTMLImageElement).src = `./php/draw_image.php/?zz=${Date.now()}`;
                    modal.classList.remove('active');
                });
        }
    }

    document.getElementById('sick').onclick = () => {
        fetch (`./php/set_new_temp.php/?id=${id}&temp=c`)
            .then(() => {
                (document.getElementById('chart') as HTMLImageElement).src = `./php/draw_image.php/?zz=${Date.now()}`;
                modal.classList.remove('active');
            });
    }

    document.getElementById('no-data').onclick = () => {
        fetch (`./php/set_new_temp.php/?id=${id}&temp=null`)
            .then(() => {
                (document.getElementById('chart') as HTMLImageElement).src = `./php/draw_image.php/?zz=${Date.now()}`;
                modal.classList.remove('active');
            });
    }

    document.getElementById('abort').onclick = () => {
        modal.classList.remove('active');
    }
}