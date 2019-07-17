SELECT piID, stID, tiQty, tiActual, tiSubtotal  FROM purchase_items LEFT JOIN transitems USING (piID)
WHERE tiType = 'restock'

SELECT piID, tiType, tiSubtotal FROM purchase_items LEFT JOIN transitems USING (piID)

SELECT ti.piID, tiType, tiSubtotal, pType  FROM purchase_items pri  LEFT JOIN transitems ti USING (piID) LEFT JOIN pur_items pi ON (pri.piID = pi.piID) LEFT JOIN purchases p ON (pi.pID = p.pID) WHERE tiType = 'restock'

SELECT tiID, ti.piID, stID, tiQty, tiActual, tiType, tiSubtotal, pType  FROM purchase_items pri  LEFT JOIN transitems ti USING (piID) LEFT JOIN pur_items pi ON (pri.piID = pi.piID) LEFT JOIN purchases p ON (pi.pID = p.pID) WHERE tiType = 'restock' and pType = 'delivery' GROUP BY tiID

SELECT tiID, pi.pID, ti.piID, stID, tiQty, tiActual, tiType, tiSubtotal, pType  FROM purchase_items pri  LEFT JOIN transitems ti USING (piID) LEFT JOIN pur_items pi ON (pri.piID = pi.piID) LEFT JOIN purchases p ON (pi.pID = p.pID) WHERE tiType = 'restock' and pType = 'delivery' GROUP BY tiID

SELECT tiID, pi.pID, ti.piID, receiptNo, stID, tiQty, tiActual, tiType, tiSubtotal, pType FROM purchase_items pri LEFT JOIN transitems ti USING (piID) LEFT JOIN pur_items pi ON 

SELECT tiID, pi.pID, ti.piID, receiptNo, stID, tiQty, tiActual, tiType, tiSubtotal, piStatus, priStatus, pType, pDateRecorded, dateRecorded FROM purchase_items pri LEFT JOIN transitems ti USING (piID) LEFT JOIN pur_items pi ON (pri.piID = pi.piID) LEFT JOIN purchases p ON (ti.dateRecorded = p.pDateRecorded) WHERE tiType = 'restock' and pType = 'delivery'

SELECT tiID, pi.pID, ti.piID, receiptNo, stID, tiQty, tiActual, tiType, tiSubtotal, piStatus, priStatus, pType, pDateRecorded, dateRecorded FROM purchase_items pri LEFT JOIN transitems ti USING (piID) LEFT JOIN pur_items pi ON (pri.piID = pi.piID) LEFT JOIN purchases p ON (pi.pID = p.pID) WHERE tiType = 'restock' and pType = 'delivery'
AND p.pDateRecorded = ti.dateRecorded

SELECT tiID, pi.pID, ti.piID, receiptNo, stID, tiQty, tiActual, tiType, tiSubtotal, piStatus, priStatus, pType, pDateRecorded, dateRecorded FROM purchase_items pri LEFT JOIN transitems ti USING (piID) LEFT JOIN pur_items pi ON (pri.piID = pi.piID) LEFT JOIN purchases p ON (pi.pID = p.pID) LEFT JOIN suppliermerchandise USING (spmID) WHERE tiType = 'restock' and pType = 'delivery'
AND p.pDateRecorded = ti.dateRecorded

SELECT tiID, pi.pID, ti.piID, receiptNo, ti.stID, stName, spmName, spmPrice, spmActual, tiQty, tiActual, tiType, tiSubtotal, piStatus, priStatus, pType, pDateRecorded, dateRecorded FROM purchase_items pri LEFT JOIN transitems ti USING (piID) LEFT JOIN pur_items pi ON (pri.piID = pi.piID) LEFT JOIN purchases p ON (pi.pID = p.pID) LEFT JOIN stockitems st ON (ti.stID = st.stID) LEFT JOIN suppliermerchandise spm USING (spmID) LEFT JOIN uom USING (spm.uomID = uom.uomID) WHERE tiType = 'restock' and pType = 'delivery'
AND p.pDateRecorded = ti.dateRecorded