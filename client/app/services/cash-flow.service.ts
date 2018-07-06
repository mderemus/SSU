
// DEPENDENCIES
import { Observable } from 'rxjs/Rx';
import { Http, RequestOptions, Headers, Response } from '@angular/http';
import { Injectable } from '@angular/core';
import 'rxjs/add/operator/map';

// SECURITY
import { AuthenticationService } from '../security/authentication.service';

// CONFIG
import { config } from "../../config/properties";

// MODEL
import { CashFlowBaseService } from "./base/cash-flow.base.service";
import { CashFlow } from '../domain/ssu_db/cash-flow';

/**
 * YOU CAN OVERRIDE HERE CashFlowBaseService
 */

@Injectable()
export class CashFlowService extends CashFlowBaseService {
    
    // CONSTRUCTOR
    constructor(http: Http, authenticationService: AuthenticationService) {
            super(http, authenticationService);
    }
    
}