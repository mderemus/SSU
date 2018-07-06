
/**
 * 
 * 
  _____                      _              _ _ _     _   _     _        __ _ _      
 |  __ \                    | |            | (_) |   | | | |   (_)      / _(_) |     
 | |  | | ___    _ __   ___ | |_    ___  __| |_| |_  | |_| |__  _ ___  | |_ _| | ___ 
 | |  | |/ _ \  | '_ \ / _ \| __|  / _ \/ _` | | __| | __| '_ \| / __| |  _| | |/ _ \
 | |__| | (_) | | | | | (_) | |_  |  __/ (_| | | |_  | |_| | | | \__ \ | | | | |  __/
 |_____/ \___/  |_| |_|\___/ \__|  \___|\__,_|_|\__|  \__|_| |_|_|___/ |_| |_|_|\___|
 
 * DO NOT EDIT THIS FILE!! 
 * 
 *  FOR CUSTOMIZE CashFlowBaseService PLEASE EDIT ../CashFlow.service.ts
 * 
 *  -- THIS FILE WILL BE OVERWRITTEN ON THE NEXT SKAFFOLDER'S CODE GENERATION --
 * 
 */
 
//DEPENDENCIES
import { Observable } from 'rxjs/Rx';
import { Http, RequestOptions, Headers, Response } from '@angular/http';
import { Injectable } from '@angular/core';
import 'rxjs/add/operator/map';

// SECURITY
import { AuthenticationService } from '../../security/authentication.service';

// MODEL
import { CashFlow } from '../../domain/ssu_db/cash-flow';

// CONFIG
import { config } from "../../../config/properties";

/**
 * THIS SERVICE MAKE HTTP REQUEST TO SERVER, FOR CUSTOMIZE IT EDIT ../CashFlow.service.ts
 */
 
/*
 * SCHEMA DB CashFlow
 * 
	{
		addition: {
			type: 'Boolean'
		},
		amount: {
			type: 'Decimal'
		},
		description: {
			type: 'String'
		},
		transaction_date: {
			type: 'Date'
		},
		//RELATIONS
		
		
		//EXTERNAL RELATIONS
		
		accountid: [{
			type: Schema.ObjectId,
			ref : "CashFlow"
		}],
		userid: [{
			type: Schema.ObjectId,
			ref : "CashFlow"
		}],
		
	}
 * 
 */
@Injectable()
export class CashFlowBaseService {

    contextUrl:string = config.host + "/cashflows";
    constructor(
        protected http: Http,
        protected authenticationService: AuthenticationService) {
        
    }

//CRUD METHODS
	
	/**
     * Create new item
     */
     create(item: CashFlow): Observable<CashFlow> {
        return this.http
            .post(this.contextUrl, item)
            .map(response => response.json());
    }
	
	/**
     * Remove one item by id
     */
     remove(id: string): Observable<void> {
        return this.http
            .delete(this.contextUrl + "/" + id)
            .map(response => null);
    }
	
    /**
     * Get one item by id
     */
	
	get(id: string): Observable<CashFlow> {
        return this.http
            .get(this.contextUrl + "/" + id)
            .map(response => response.json() as CashFlow)
    }

	
    /**
     * Get list of items
     */
	
	list(): Observable<CashFlow[]> {
        return this.http
            .get(this.contextUrl)
            .map(response => response.json() as CashFlow[])
    }
	
    /**
     * Update item
     */
	update(item: CashFlow): Observable<CashFlow> {
        return this.http
            .post(this.contextUrl + '/' + item._id, item)
            .map(response => response.json())
    }



}
