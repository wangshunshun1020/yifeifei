import {Base} from '../utils/base.js';

class Brand extends Base{
    constructor(){
        super();
    }

 


    getBrandList(callback,params){
        var that=this;
        var param={
            url: 'v1.Brand/getbrandlist',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }

    
    getBrandCarsList(callback,params){
        var that=this;
        var param={
            url: 'v1.Brand/getBrandCarsList',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }




};

export {Brand};