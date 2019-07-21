SELECT spmID,tiID, pi.dID, ti.diID, ti.piID, receiptNo, ti.stID, stName, CONCAT(stName,' ',stSize) as stock, CONCAT(spmName,' ',stSize) as merch,
        stSize, spmName, spmPrice, spmActual, tiQty as qty, uomName, tiActual as actual, tiType, tiSubtotal, 
        piStatus, priStatus, pType, pDateRecorded, dateRecorded FROM purchase_items pri LEFT JOIN transitems ti USING (piID) 
        LEFT JOIN pur_items pi ON (pri.piID = pi.piID) LEFT JOIN purchases p ON (pi.pID = p.pID) LEFT JOIN stockitems st 
        ON (ti.stID = st.stID) LEFT JOIN suppliermerchandise spm USING (spmID) LEFT JOIN uom ON (spm.uomID = uom.uomID) 
        WHERE tiType = 'restock' and pType = 'delivery' AND p.pDateRecorded = ti.dateRecorded

    SELECT * FROM delivery_items di LEFT JOIN transitems ti USING (diID) 
        LEFT JOIN deliveries d USING (dID) LEFT JOIN stockitems st 
        ON (ti.stID = st.stID) LEFT JOIN suppliermerchandise spm USING (spmID) LEFT JOIN uom ON (spm.uomID = uom.uomID) 
        WHERE tiType = 'restock'

        
    SELECT * FROM delivery_items di LEFT JOIN transitems ti USING (diID) 
        LEFT JOIN deliveries d USING (dID) LEFT JOIN purchase_items USING (piID) LEFT JOIN stockitems st 
        ON (ti.stID = st.stID) LEFT JOIN suppliermerchandise spm USING (spmID) LEFT JOIN uom ON (spm.uomID = uom.uomID) 
        WHERE tiType = 'restock'

        SELECT spmID,tiID, d.dID, di.diID, ti.piID, receiptNo, ti.stID, stName, CONCAT(stName,' ',stSize) as stock, 
        CONCAT(spmName,' ',stSize) as merch, stSize, spmName, spmPrice, spmActual, tiQty as qty, uomName, tiActual as actual, 
        tiType, tiSubtotal, diStatus, piStatus FROM delivery_items di LEFT JOIN transitems ti USING (diID) 
        LEFT JOIN deliveries d USING (dID) LEFT JOIN purchase_items USING (piID) LEFT JOIN stockitems st ON (ti.stID = st.stID) 
        LEFT JOIN suppliermerchandise spm USING (spmID) LEFT JOIN uom ON (spm.uomID = uom.uomID) WHERE tiType = 'restock'

        SELECT spmID,tiID, d.dID, di.diID, ti.piID, receiptNo, ti.stID, stName, CONCAT(stName,' ',stSize) as stock, 
        CONCAT(spmName,' ',stSize) as merch, stSize, spmName, spmPrice, spmActual, tiQty as qty, uomName, tiActual as actual, 
        tiType, tiSubtotal, diStatus, piStatus FROM delivery_items di LEFT JOIN transitems ti USING (diID) LEFT JOIN deliveries d USING (dID) 
        LEFT JOIN purchase_items USING (piID) LEFT JOIN stockitems st ON (ti.stID = st.stID) LEFT JOIN suppliermerchandise spm 
        USING (spmID) LEFT JOIN uom ON (spm.uomID = uom.uomID) INNER JOIN (SELECT max(tiID) as tiID FROM transitems ti GROUP BY diID)
         AS maxNew USING (tiID) WHERE tiType = 'restock'