function createIcons(amount,font,listSet,min_x,min_y,max_x,max_y) {
    let colors = [
        'grey' , 'white' , 'lightgrey' 
    ]

    let list = [];
    for( let ind = 0 ; ind < amount ; ind++ ) {
        let iconNode = document.createElement('span');
        iconNode.classList.add('font-icon');
        iconNode.style.fontFamily = font;

        iconNode.style.left     = (min_x + Math.random() * Math.abs(max_x-min_x)) + 'px';
        iconNode.style.top      = (min_y + Math.random() * Math.abs(max_y-min_y)) + 'px';
        iconNode.style.color    = colors[Math.round(Math.random()*(colors.length-1))];
        iconNode.style.fontSize = (128 + Math.random()*128) + 'px';

        iconNode.innerHTML = listSet[Math.round((listSet.length-1)*Math.random())];

        list.push(iconNode);
    }

    return list;
}