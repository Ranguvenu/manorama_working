<?php

namespace App\Services;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\SapController;
use GuzzleHttp\Client;

class SAPService
{
    private $sapendpoint = 'http://220.227.88.41:8111';

    private $username = 'mmonline';

    private $password = 'poq#1234';

    public function __construct()
    {
        $this->client = new Client(['http_errors' => false, 'verify' => false]);
    }

    public function submit_order_file(SapController $sap)
    {
        $payload = [];
        $payload['auth'] = [
            $this->username,
            $this->password,
        ];

        $payload['headers'] = [
            'Content-Type' => 'application/xml',
        ];
        $payload['body'] = $sap->payload;
        $response = $this->make_request('POST', $payload, '/XISOAPAdapter/MessageServlet?channel=:BC_Peripheral:CC_Horizon_Outbound');
        $sapresponse = [];
        $sapresponse['payload'] = $sap->payload;
        $sapresponse['response'] = $response['data'];
        $sapresponse['response_status'] = $response['code'];
        $sapresponse['sap_status'] = ($response && $response['success']) ? 1 : 0;
        if ($response && $response['success']) {
            $sap->is_submitted = true;
        }
        $sap->last_submited_at = time();
        $sap->increment('attempts');
        $sap->save();
        $sap->responses()->create($sapresponse);

        return $response;
    }

    public function submit_reconcilation_file(SapController $sap)
    {
        $payload = [];
        $payload['auth'] = [
            $this->username,
            $this->password,
        ];

        $payload['headers'] = [
            'Content-Type' => 'application/xml',
        ];
        $payload['body'] = $sap->payload;
        $response = $this->make_request('POST', $payload, '/XISOAPAdapter/MessageServlet?version=3.0&Sender.Service=BC_Peripheral&Interface=http%3A%2F%2Fwww.apps.mm.com%2Fperipheral%2FHorizon%5ESI_Horizon_Recon_Outbound');
        $sapresponse = [];
        $sapresponse['payload'] = $sap->payload;
        $sapresponse['response'] = $response['data'];
        $sapresponse['response_status'] = $response['code'];
        $sapresponse['sap_status'] = ($response && $response['success']) ? 1 : 0;
        if ($response && $response['success']) {
            $sap->is_submitted = true;
        }
        $sap->last_submited_at = time();
        $sap->increment('attempts');
        $sap->save();
        $sap->responses()->create($sapresponse);

        return $response;
    }

    public function upload_order_file(Order $order)
    {
        try {
            $user = $order->user;
            $data = [
                'firstname' => $user ? $user->firstname : '',
                'lastname' => $user ? $user->lastname : '',
                'address1' => $user ? $user->address : '',
                'address2' => $user ? $user->address2 : '',
                'city' => $user ? $user->city : '',
                'state' => $user ? $user->state_name : '',
                'country' => $user ? $user->country_name : '',
                'phone_number' => $user ? $user->phone_number : '',
                'email' => $user ? $user->email : '',
                'orderid' => $order->order_key,
                'orderdate' => get_date($order->created_at, 'Y-m-d'),
                'packageid' => $order->package_id,
                'orderstatus' => $order->status_name,
                'transactionid' => $order->order_key,
                'txid' => $order->transaction_id,
                'reference_key' => $order->reference_key,
                'gateway' => $order->gateway,
                'amount' => $order->package_pricing ? $order->package_pricing->sap_ism_amount : '',
                'sap_type_id' => $order->package_pricing ? $order->package_pricing->sap_type_id : '',
            ];

            $variables = $this->order_payload_variables($data);

            $payload = $this->get_order_payload($variables);

            $order->sap_controller()->create([
                    'sap_type' => 1,
                    'payload' => $payload,
                    'last_submited_at' => 0,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Sap Uploaded Successfully',
                'data' => $order,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 200);
        }
    }

    public function upload_reconcilation_file(Order $order)
    {
        try {
            $user = $order->user;
            $data = [
                'firstname' => $user ? $user->firstname : '',
                'lastname' => $user ? $user->lastname : '',
                'fullname' => $user ? $user->fullname : '',
                'address1' => $user ? $user->address : '',
                'address2' => $user ? $user->address2 : '',
                'city' => $user ? $user->city : '',
                'state' => $user ? $user->state_name : '',
                'country' => $user ? $user->country_name : '',
                'phone_number' => $user ? $user->phone_number : '',
                'email' => $user ? $user->email : '',
                'orderid' => $order->order_key,
                'orderdate' => get_date($order->created_at, 'Y-m-d'),
                'packageid' => $order->package_id,
                'orderstatus' => $order->status_name,
                'transactionid' => $order->order_key,
                'txid' => $order->transaction_id,
                'reference_key' => $order->reference_key,
                'gateway' => $order->gateway,
                'amount' => $order->package_pricing ? $order->package_pricing->sap_ism_amount : '',
                'sap_type_id' => $order->package_pricing ? $order->package_pricing->sap_type_id : '',
            ];

            $variables = $this->reconcilation_payload_variables($data);

            $payload = $this->get_reconilation_payload($variables);

            $order->sap_controller()->create([
                    'sap_type' => 2,
                    'payload' => $payload,
                    'last_submited_at' => 0,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Sap Uploaded Successfully',
                'data' => $order,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 200);
        }
    }

    private function get_order_payload($variables)
    {
        $payload = $this->get_order_payload_format();

        return $this->genenrate_payload($variables, $payload);
    }

    private function get_reconilation_payload($variables)
    {
        $payload = $this->get_reconilation_payload_format();

        return $this->genenrate_payload($variables, $payload);
    }

    private function genenrate_payload($variables, $format)
    {
        foreach ($variables as $key => $value) {
            $format = str_replace($key, $value, $format);
        }

        return $format;
    }

    private function order_payload_variables($data)
    {
        return [
            '{{CUSTADDR_FNAME}}' => $data['firstname'],
            '{{CUSTADDR_LNAME}}' => $data['lastname'],
            '{{CUSTADDR_BADDR1}}' => $data['address1'],
            '{{CUSTADDR_BADDR2}}' => $data['address2'],
            '{{CUSTADDR_BCITY}}' => $data['city'],
            '{{CUSTADDR_BBEZEI}}' => $data['state'],
            '{{CUSTADDR_BCOUNTRY}}' => $data['country'],
            '{{CUSTADDR_BPH_MOB}}' => $data['phone_number'],
            '{{CUSTADDR_BEMAIL_ID}}' => $data['email'],
            '{{CUSTADDR_ONL_DOCNO}}' => $data['orderid'],
            '{{HEADER_TR_DATE}}' => $data['orderdate'],
            '{{CUSTADDR_BEMAIL_ID}}' => $data['email'],
            '{{PACKAGE_ID}}' => $data['packageid'],
            '{{PAYMENT_TYPEID}}' => $data['sap_type_id'],
            '{{PAYMENT_STARTDATE}}' => $data['orderdate'],
            '{{PAYMENT_ENDDATE}}' => $data['orderdate'],
            '{{PAYMENT_STATUS}}' => $data['orderstatus'],
            '{{TRANSCATION_ID}}' => $data['txid'],
            '{{PAYMENT_PRD_DESP}}' => $data['reference_key'],
            '{{PAYMENT_MID}}' => $data['reference_key'],
            '{{PAYMENT_ZRRN}}' => $data['txid'],
            '{{AUTHCODE}}' => $data['txid'],
            '{{PAYMENT_PGTID}}' => $data['txid'],
            '{{PAYMENT_BANK_NAME}}' => $data['gateway'],
            '{{PAYMENT_WRBTR}}' => $data['amount'],
        ];
    }

    private function reconcilation_payload_variables($data)
    {
        return [
            '{{Recon_Stat}}' => '',
            '{{Recon_Rstat}}' => '',
            '{{Recon_Tstat}}' => 'S',
            '{{Recon_Pstat}}' => '',
            '{{Recon_Mid}}' => $data['reference_key'],
            '{{Recon_Crdt}}' => $data['orderdate'],
            '{{Recon_Mttid}}' => $data['txid'],
            '{{Recon_Hbkid}}' => '',
            '{{Recon_Bukrs}}' => '',
            '{{Recon_Vkbur}}' => '',
            '{{Recon_Pg}}' => $data['gateway'],
            '{{Recon_Rrnid}}' => $data['txid'],
            '{{Recon_Autid}}' => $data['txid'],
            '{{Recon_Pgtid}}' => $data['txid'],
            '{{Recon_Ordid}}' => $data['txid'],
            '{{Recon_Wrbtr}}' => $data['amount'],
            '{{Recon_Waers}}' => 'INR',
            '{{Recon_Cusid}}' => $data['email'],
            '{{Recon_Cusn}}' => $data['firstname'],
            '{{Recon_CID}}' => $data['email'],
            '{{Recon_Name}}' => $data['fullname'],
            '{{Recon_Address1}}' => $data['address1'],
            '{{Recon_Address2}}' => $data['address2'],
            '{{Recon_City}}' => $data['city'],
            '{{Recon_State}}' => $data['state'],
            '{{Recon_Country}}' => $data['country'],
            '{{Recon_TelNum}}' => $data['phone_number'],
            '{{Recon_Email}}' => $data['email'],
            '{{Recon_Rdoc}}' => '',
            '{{Recon_Fidoc}}' => '',
            '{{Recon_Pdate}}' => '',
            '{{Recon_ReconUser}}' => '',
            '{{Recon_RefundUser}}' => '',
            '{{Recon_RefundIm}}' => '',
            '{{Recon_RefundEx}}' => '',
            '{{Recon_RejectRs}}' => '',
            '{{Recon_Updusr}}' => '',
            '{{Recon_Upddt}}' => '',
            '{{Recon_Updti}}' => '',
            '{{Recon_FilNam}}' => '',
            '{{Recon_Message}}' => '',
            '{{Recon_Return_Type}}' => '',
            '{{Recon_Return_Code}}' => '',
            '{{Recon_Return_Message}}' => '',
            '{{Recon_Return_LogNo}}' => '',
            '{{Recon_Return_LogMsgNo}}' => '',
            '{{Recon_Return_MessageV1}}' => '',
            '{{Recon_Return_MessageV2}}' => '',
            '{{Recon_Return_MessageV3}}' => '',
            '{{Recon_Return_MessageV4}}' => 'authorized',
        ];
    }

    private function get_order_payload_format()
    {
        $payload = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
                        <soapenv:Header/>
                        <soapenv:Body>
                            <urn:ZFMMAMONLSERVICE>
                                <!--Optional:-->
                                <ADSPECS>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <AD_SPEC></AD_SPEC>
                                        <WORD_COUNT></WORD_COUNT>
                                        <WIDTH></WIDTH>
                                        <WIDTH_UOM></WIDTH_UOM>
                                        <HEIGHT></HEIGHT>
                                        <HEIGHT_UOM></HEIGHT_UOM>
                                        <COLOR_SCHEME></COLOR_SCHEME>
                                        <BACK_COLOR></BACK_COLOR>
                                        <BODY_TEXT></BODY_TEXT>
                                        <EBOX_NO></EBOX_NO>
                                    </item>
                                </ADSPECS>
                                <!--Optional:-->
                                <MATERIAL>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <DRVORLART></DRVORLART>
                                        <DRVORLANZ></DRVORLANZ>
                                    </item>
                                </MATERIAL>
                                <!--Optional:-->
                                <ORD_CUST_ADDR>
                                    <ANRED>1</ANRED>
                                    <NAME1>{{CUSTADDR_FNAME}}</NAME1>
                                    <NAME2>{{CUSTADDR_LNAME}}</NAME2>
                                    <NAME3>{{CUSTADDR_BADDR1}}</NAME3>
                                    <NAME4>{{CUSTADDR_BADDR2}}</NAME4>
                                    <ORT01>{{CUSTADDR_BCITY}}</ORT01>
                                    <ORT02></ORT02>
                                    <STRAS></STRAS>
                                    <PSTLZ></PSTLZ>
                                    <STATE>{{CUSTADDR_BBEZEI}}</STATE>
                                    <COUNTRY>{{CUSTADDR_BCOUNTRY}}</COUNTRY>
                                    <ISPTELP>{{CUSTADDR_BPH_MOB}}</ISPTELP>
                                    <ISPTELD></ISPTELD>
                                    <EMAIL>{{CUSTADDR_BEMAIL_ID}}</EMAIL>
                                </ORD_CUST_ADDR>
                                <!--Optional:-->
                                <ORD_HEAD>
                                    <SEUID></SEUID>
                                    <GPAG></GPAG>
                                    <VKBUR></VKBUR>
                                    <VKORG></VKORG>
                                    <VTWEG></VTWEG>
                                    <SPART></SPART>
                                    <AUART></AUART>
                                    <ZZBILLTYPE></ZZBILLTYPE>
                                    <PSTYV></PSTYV>
                                    <AMOUNT></AMOUNT>
                                    <RAB1_BETR></RAB1_BETR>
                                    <AGD_PRICE></AGD_PRICE>
                                    <STAT></STAT>
                                    <ZZPANNO></ZZPANNO>
                                    <ZZGST></ZZGST>
                                    <ZZADHARNO></ZZADHARNO>
                                    <ZZREFNO></ZZREFNO>
                                    <BATCH_PROC></BATCH_PROC>
                                </ORD_HEAD>
                                <!--Optional:-->
                                <ORD_HEAD_ONL>
                                    <SERVICE>MMHOR</SERVICE>
                                    <ORDER_ID>{{CUSTADDR_ONL_DOCNO}}</ORDER_ID>
                                    <TR_DATE>{{HEADER_TR_DATE}}</TR_DATE>
                                    <REG_ID>{{CUSTADDR_BEMAIL_ID}}</REG_ID>
                                    <ZZPANNO></ZZPANNO>
                                    <ZZGST></ZZGST>
                                    <ZZADHARNO></ZZADHARNO>
                                    <ZZTAXNO></ZZTAXNO>
                                    <BATCH_PROC> </BATCH_PROC>
                                </ORD_HEAD_ONL>
                                <!--Optional:-->
                                <ORD_ITEM>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <AD_ITEM></AD_ITEM>
                                        <BOOK_UNIT></BOOK_UNIT>
                                        <BCC></BCC>
                                        <TCC></TCC>
                                        <START_DT></START_DT>
                                        <END_DT></END_DT>
                                        <DESIGN_TYPE></DESIGN_TYPE>
                                        <ADVERTISER></ADVERTISER>
                                        <PAY_METHOD></PAY_METHOD>
                                        <PRODH></PRODH>
                                        <BILL_CLIENT> </BILL_CLIENT>
                                        <BOX_IND></BOX_IND>
                                        <BOX_LOC></BOX_LOC>
                                    </item>
                                </ORD_ITEM>
                                <!--Optional:-->
                                <ORD_ITEM_ONL>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <AD_ITEM>001</AD_ITEM>
                                        <PACKAGE_ID>{{PACKAGE_ID}}</PACKAGE_ID>
                                        <TYPEID>{{PAYMENT_TYPEID}}</TYPEID>
                                        <START_DT>{{PAYMENT_STARTDATE}}</START_DT>
                                        <END_DT>{{PAYMENT_ENDDATE}}</END_DT>
                                        <STATUS>{{PAYMENT_STATUS}}</STATUS>
                                    </item>
                                </ORD_ITEM_ONL>
                                <!--Optional:-->
                                <ORD_PAYMENT_ONL>
                                    <TRANS_ID>SO</TRANS_ID>
                                    <MTTID>{{PAYMENT_PRD_DESP}}</MTTID>
                                    <MID>{{PAYMENT_MID}}</MID>
                                    <RRNID>{{PAYMENT_ZRRN}}</RRNID>
                                    <AUTID>{{AUTHCODE}}</AUTID>
                                    <RTRN>{{PAYMENT_PGTID}}</RTRN>
                                    <CCBNK>{{PAYMENT_BANK_NAME}}</CCBNK>
                                    <WRBTR>{{PAYMENT_WRBTR}}</WRBTR>
                                    <CURRENCY>INR</CURRENCY>
                                </ORD_PAYMENT_ONL>
                                <!--Optional:-->
                                <ORD_STATUS>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <UNIQUE_ID></UNIQUE_ID>
                                        <WRBTR></WRBTR>
                                        <USERID></USERID>
                                        <STATUS></STATUS>
                                        <MESSAGE></MESSAGE>
                                    </item>
                                </ORD_STATUS>
                                <!--Optional:-->
                                <ORD_TCCPARVAL>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <INHK_TECH1></INHK_TECH1>
                                        <PARM_CODE></PARM_CODE>
                                        <PARAM_VALUE></PARAM_VALUE>
                                    </item>
                                </ORD_TCCPARVAL>
                                <!--Optional:-->
                                <PAYMENTS>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <ITEM_NO></ITEM_NO>
                                        <MTTID></MTTID>
                                        <MID></MID>
                                        <RRNID></RRNID>
                                        <AUTID></AUTID>
                                        <RTRN></RTRN>
                                        <CCBNK></CCBNK>
                                        <WRBTR></WRBTR>
                                        <SOFF></SOFF>
                                        <CURRKEY></CURRKEY>
                                        <PAY_MTD></PAY_MTD>
                                        <DOC_DATE></DOC_DATE>
                                        <POST_DATE></POST_DATE>
                                        <CHQDD_NO></CHQDD_NO>
                                        <CHQDD_DT></CHQDD_DT>
                                        <CHQ_FROM></CHQ_FROM>
                                        <HOUSE_BANK></HOUSE_BANK>
                                        <ISS_BANK_KEY></ISS_BANK_KEY>
                                        <ISS_BANK></ISS_BANK>
                                        <ISS_BRANCH></ISS_BRANCH>
                                        <ISS_PLACE></ISS_PLACE>
                                        <PAY_BANK_KEY></PAY_BANK_KEY>
                                        <PAY_BANK></PAY_BANK>
                                        <PAY_BRANCH></PAY_BRANCH>
                                        <PAY_PLACE></PAY_PLACE>
                                        <BNKCHRG></BNKCHRG>
                                        <PRCTR></PRCTR>
                                        <SALES_OFF></SALES_OFF>
                                        <REMARKS></REMARKS>
                                        <CHQ_TYP></CHQ_TYP>
                                        <POST_CHQ></POST_CHQ>
                                        <GUR_CHQ></GUR_CHQ>
                                        <CARD_TYPE></CARD_TYPE>
                                        <CARD_NUMBER></CARD_NUMBER>
                                        <CCNAM></CCNAM>
                                        <CCEXP></CCEXP>
                                        <HBKID_FB></HBKID_FB>
                                        <CCTRID></CCTRID>
                                        <TIDNO></TIDNO>
                                        <PARTNER></PARTNER>
                                        <SERVICE></SERVICE>
                                        <TRTYPE></TRTYPE>
                                    </item>
                                </PAYMENTS>
                                <!--Optional:-->
                                <PUB_DATES>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <AD_ITEM></AD_ITEM>
                                        <SR_NO></SR_NO>
                                        <PUB_DT></PUB_DT>
                                        <AD_SPEC></AD_SPEC>
                                        <MAT_ID></MAT_ID>
                                        <BUNDLE_FLAG></BUNDLE_FLAG>
                                    </item>
                                </PUB_DATES>
                                <!--Optional:-->
                                <REMARKS>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <LINE_TEXT> </LINE_TEXT>
                                    </item>
                                </REMARKS>
                                <!--Optional:-->
                                <STATUS_TAB>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <TYPE></TYPE>
                                        <ID></ID>
                                        <NUMBER></NUMBER>
                                        <MESSAGE></MESSAGE>
                                        <LOG_NO></LOG_NO>
                                        <LOG_MSG_NO></LOG_MSG_NO>
                                        <MESSAGE_V1></MESSAGE_V1>
                                        <MESSAGE_V2></MESSAGE_V2>
                                        <MESSAGE_V3></MESSAGE_V3>
                                        <MESSAGE_V4></MESSAGE_V4>
                                        <PARAMETER></PARAMETER>
                                        <ROW></ROW>
                                        <FIELD></FIELD>
                                        <SYSTEM></SYSTEM>
                                    </item>
                                </STATUS_TAB>
                                <!--Optional:-->
                                <WORCOUNT>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <AD_SPEC></AD_SPEC>
                                        <COND_TYPE></COND_TYPE>
                                        <WD_COUNT></WD_COUNT>
                                    </item>
                                </WORCOUNT>
                            </urn:ZFMMAMONLSERVICE>
                        </soapenv:Body>
                    </soapenv:Envelope>';

        return $payload;
    }

    private function get_reconilation_payload_format()
    {
        $payload = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:soap:functions:mc-style">
                    <soapenv:Header/>
                    <soapenv:Body>
                    <urn:Zfmnetbnkdt>
                        <IFinal>
                            <!--Zero or more repetitions:-->
                            <item>
                                <Stat>{{Recon_Stat}}</Stat>
                                <Tstat>{{Recon_Rstat}}</Tstat>
                                <Rstat>{{Recon_Tstat}}</Rstat>
                                <Pstat>{{Recon_Pstat}}</Pstat>
                                <Mid>{{Recon_Mid}}</Mid>
                                <Crdt>{{Recon_Crdt}}</Crdt>
                                <Mttid>{{Recon_Mttid}}</Mttid>
                                <Hbkid>{{Recon_Hbkid}}</Hbkid>
                                <Bukrs>{{Recon_Bukrs}}</Bukrs>
                                <Vkbur>{{Recon_Vkbur}}</Vkbur>
                                <Pg>{{Recon_Pg}}</Pg>
                                <Rrnid>{{Recon_Rrnid}}</Rrnid>
                                <Autid>{{Recon_Autid}}</Autid>
                                <Pgtid>{{Recon_Pgtid}}</Pgtid>
                                <Ordid>{{Recon_Ordid}}</Ordid>
                                <Wrbtr>{{Recon_Wrbtr}}</Wrbtr>
                                <Waers>{{Recon_Waers}}</Waers>
                                <Cusid>{{Recon_Cusid}}</Cusid>
                                <Cusn>{{Recon_Cusn}}</Cusn>
                                <Custi>{{Recon_CID}}</Custi>
                                <Name>{{Recon_Name}}</Name>
                                <Address1>{{Recon_Address1}}</Address1>
                                <Address2>{{Recon_Address2}}</Address2>
                                <City>{{Recon_City}}</City>
                                <State>{{Recon_State}}</State>
                                <Country>{{Recon_Country}}</Country>
                                <Zip>999999</Zip>
                                <TelNum>{{Recon_TelNum}}</TelNum>
                                <Email>{{Recon_Email}}</Email>
                                <Rdoc>{{Recon_Rdoc}}</Rdoc>
                                <Fidoc>{{Recon_Fidoc}}</Fidoc>
                                <Pdate>{{Recon_Pdate}}</Pdate>
                                <ReconUser>{{Recon_ReconUser}}</ReconUser>
                                <RefundUser>{{Recon_RefundUser}}</RefundUser>
                                <RefundIm>{{Recon_RefundIm}}</RefundIm>
                                <RefundEx>{{Recon_RefundEx}}</RefundEx>
                                <RejectRs>{{Recon_RejectRs}}</RejectRs>
                                <Updusr>{{Recon_Updusr}}</Updusr>
                                <Upddt>{{Recon_Upddt}}</Upddt>
                                <Updti>{{Recon_Updti}}</Updti>
                                <FilNam>{{Recon_FilNam}}</FilNam>
                                <Type></Type>
                                <Message>{{Recon_Message}}</Message>
                            </item>
                        </IFinal>
                        <!--Optional:-->
                        <IReturn>
                            <!--Zero or more repetitions:-->
                            <item>
                                <Type>{{Recon_Return_Type}}</Type>
                                <Code>{{Recon_Return_Code}}</Code>
                                <Message>{{Recon_Return_Message}}</Message>
                                <LogNo>{{Recon_Return_LogNo}}</LogNo>
                                <LogMsgNo>{{Recon_Return_LogMsgNo}}</LogMsgNo>
                                <MessageV1>{{Recon_Return_MessageV1}}</MessageV1>
                                <MessageV2>{{Recon_Return_MessageV2}}</MessageV2>
                                <MessageV3>{{Recon_Return_MessageV3}}</MessageV3>
                                <MessageV4>{{Recon_Return_MessageV4}}</MessageV4>
                            </item>
                        </IReturn>
                    </urn:Zfmnetbnkdt>
                    </soapenv:Body>
                </soapenv:Envelope>';

        return $payload;
    }

    /**
     * Make API Request.
     *
     * @param string $method
     * @param array  $payload
     */
    private function make_request($method, $payload, $url)
    {
        $url = $this->sapendpoint.$url;

        $post = $this->client->request($method,
            $url,
            $payload);

        $response = ($post->getStatusCode() == 200) ? json_decode($post->getBody(), true) : false;
        // echo '<pre>';
        // print_r($post);
        // echo '</pre>';
        if ($post->getStatusCode() == 200) {
            return [
                'success' => true,
                'code' => $post->getStatusCode(),
                'data' => (string) $post->getBody(),
            ];
        } else {
            return [
                'success' => false,
                'code' => $post->getStatusCode(),
                'data' => (string) $post->getBody(),
            ];
        }

        return $response;
    }
}
