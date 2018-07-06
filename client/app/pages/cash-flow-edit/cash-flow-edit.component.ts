// Import Libraries
import { ActivatedRoute, Params } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { Location } from '@angular/common';

// Import Services
import { CashFlowService } from '../../services/cash-flow.service';
import { UserService } from '../../services/user.service';
import { AccountService } from '../../services/account.service';

// Import Models
import { CashFlow } from '../../domain/ssu_db/cash-flow';
import { Account } from '../../domain/ssu_db/account';import { User } from '../../domain/ssu_db/user';
// START - USED SERVICES
/*
 *	CashFlowService.create
 *		PARAMS: 
 *		
 *
 *	CashFlowService.get
 *		PARAMS: 
 *					ObjectId id - Id 
 *		
 *
 *	UserService.list
 *		PARAMS: 
 *		
 *
 *	AccountService.list
 *		PARAMS: 
 *		
 *
 *	CashFlowService.update
 *		PARAMS: 
 *					ObjectId id - Id
 *		
 *
 */
// END - USED SERVICES

// START - REQUIRED RESOURCES
/*
 * AccountService  
 * CashFlowService  
 * UserService  
 */
// END - REQUIRED RESOURCES

/**
 * Edit component for CashFlowEdit
 */
@Component({
    selector: 'cash-flow-edit',
    templateUrl : './cash-flow-edit.component.html',
    styleUrls: ['./cash-flow-edit.component.css']
})
export class CashFlowEditComponent implements OnInit {

    item: CashFlow;
    listAccountid: Account[];
    listUserid: User[];
    model: CashFlow;
    
    constructor(
        private cashflowService: CashFlowService,
        private userService: UserService,
        private accountService: AccountService,
        private route: ActivatedRoute,
        private location: Location) {
        // Init item
        this.item = new CashFlow();
    }

    ngOnInit(): void {
            this.route.params.subscribe(param => {
                let id: string = param['id'];
                if (id !== 'new') {
                    // Get item from server 
                    this.cashflowService.get(id).subscribe(item => this.item = item);
                    
                    
                }
                this.accountService.list().subscribe(list => this.listAccountid = list);
                this.userService.list().subscribe(list => this.listUserid = list);
            });
    }

    /**
     * Save Item
     */
    save (formValid:boolean, item: CashFlow): void{
        if (formValid) {
            if(item._id){
                this.cashflowService.update(item).subscribe(data => this.goBack());
            } else {
                this.cashflowService.create(item).subscribe(data => this.goBack());
            }  
        }
    }

    /**
     * Go Back
     */
    goBack(): void {
        this.location.back();
    }
    
    /**
     * Account Relations utils functions
     */
    containAccount(id: string){
        if(!this.item.accountid) return false;
        return this.item.accountid.indexOf(id) != -1;
    }
    
    addAccount(id: string) {
        if(!this.item.accountid)
            this.item.accountid = [];
        this.item.accountid.push(id);
    }
    
    removeAccount(index: number) {
        this.item.accountid.splice(index,1);
    }
    /**
     * User Relations utils functions
     */
    containUser(id: string){
        if(!this.item.userid) return false;
        return this.item.userid.indexOf(id) != -1;
    }
    
    addUser(id: string) {
        if(!this.item.userid)
            this.item.userid = [];
        this.item.userid.push(id);
    }
    
    removeUser(index: number) {
        this.item.userid.splice(index,1);
    }

}