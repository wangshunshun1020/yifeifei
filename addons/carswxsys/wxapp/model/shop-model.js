
import {Base} from '../utils/base.js';

class Shop extends Base{
    constructor(){
        super();
    }

    getShopRegisterInit(callback,params){
        var that=this;
        var param={
            url: 'shopregisterinit',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }

    Saveshop(callback,params){
      var that=this;
      var param={
          url: 'saveshop',
          type:'post',
          data:params,
          sCallback:function(data){
              data=data;
              callback && callback(data);
          }
      };
      this.request(param);
  }

  updateShop(callback,params){
    var that=this;
    var param={
        url: 'updateshop',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
}

  Login(callback,params){
    var that=this;
    var param={
        url: 'login',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
    }


    companycenter(callback,params){
        var that=this;
        var param={
            url: 'companycenter',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
        }


    getshoplist(callback,params){
            var that=this;
            var param={
                url: 'getshoplist',
                type:'post',
                data:params,
                sCallback:function(data){
                    data=data;
                    callback && callback(data);
                }
            };
            this.request(param);
            }


    getshopdetail(callback,params){
                var that=this;
                var param={
                    url: 'getshopdetail',
                    type:'post',
                    data:params,
                    sCallback:function(data){
                        data=data;
                        callback && callback(data);
                    }
                };
                this.request(param);
                }

                

    checkLogin(callback,params){

        var that =this;

   
            var param={
                url: 'checkshop',
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

export {Shop};