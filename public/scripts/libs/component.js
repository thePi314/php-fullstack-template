class Component {
    constructor(){};

    static name = '';

    static init(){
        this.functions();
    }
    static functions(){
        console.log(this.name);
    }

}

var ScriptRouter = {
    components: [],
    run: function (current) {
        for (let ind = 0; ind < ScriptRouter.components.length; ind++) {
            if (current == ScriptRouter.components[ind].name) {
                ScriptRouter.components[ind].init();
                return true;
            }
        }

        return false;
    }
};