<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quotation <?php echo $data_info->reference_no; ?></title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 13px;
            color: #000;
        }
        .page {
            /* width: 210mm;
            height: 297mm; */
            page-break-after: always;
            position: relative;
        }
        .page:last-child {
            page-break-after: auto;
        }
        .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .content {
            position: relative;
            z-index: 2;
        }
        
        .font-11 { font-size: 11px; }
        .font-13 { font-size: 13px; }
        .font-15 { font-size: 15px; }
    </style>
</head>
<body>

<!-- ========= PAGE 1 ========= -->
<div class="page">
    <img src="<?php echo base_url('assets/media/qt_design/1.jpg'); ?>" class="bg">
    <div class="content">
        <table style="width:100%;">
            <tr>
                <td style="padding: 249px 0px 0px 110px;"><?php echo date('d-m-Y', strtotime($data_info->qauote_date)); ?></td>
                <td style="padding: 236px 0 0 490px;"><?php echo $data_info->reference_no ?? '________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 8px 0 0 143px;"><?php echo $franchisee->franchisee_code ?? '_______'; ?></td>
            </tr>
            <tr>
                <td style="padding: 100px 0 0 98px;"><?php echo $client->client_name ?? '_________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 9px 0 0 113px;"><?php echo $client->client_email ?? '________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 8px 0 0 163px;"><?php echo $client->phone ?? '________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 6px 0 0 143px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <?php echo $client->address ?? '________'; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 108px 0 0 172px;"><?php echo $vendor->vendor_name ?? '________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 21px 0 0 172px;"><?php echo $vendor->state_name ?? '________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 14px 0 0 172px;"><?php echo $vendor->address ?? '_______'; ?></td>
            </tr>
            <tr>
                <td style="padding: 27px 0 0 172px;"><?php echo $vendor->gstin_number ?? '_______'; ?></td>
            </tr>
            <tr>
                <td style="padding: 25px 0 0 232px;"><?php echo $vendor->account_number ?? '________'; ?></td>
            </tr>
        </table>
    </div>
</div>

<!-- ========= PAGE 2 ========= -->
<div class="page">
    <img src="<?php echo base_url('assets/media/qt_design/2.jpg'); ?>" class="bg">
    <div class="content">
        <table style="width:100%;">
            <tr>
                <td style="padding: 257px 0 0 126px;"><?php echo $project->project_name ?? '________________________________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 9px 0 0 185px;"><?php echo $project->qty.' KW' ?? '_________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 0 0 0 194px;"><?php echo $project->project_type ?? '________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 0 0 0 194px;"><?php echo $project->basic_rate ?? '______'; ?></td>
            </tr>
            <tr>
                <td style="padding: 0 0 0 214px;"><?php echo $project->amount ?? '_______'; ?></td>
            </tr>
            <tr>
                <td style="padding: 1px 0 0 188px;"><?php echo $data_info->work_scope ?? 'NA'; ?></td>
            </tr>
            <tr>
                <td style="padding: 1px 0 0 240px;"><?php echo $data_info->specification ?? 'NA'; ?></td>
            </tr>
        </table>
    </div>
</div>

<!-- ========= PAGE 3 ========= -->
<div class="page">
    <img src="<?php echo base_url('assets/media/qt_design/3.jpg'); ?>" class="bg">
</div>

<!-- ========= PAGE 4 ========= -->
<div class="page">
    <img src="<?php echo base_url('assets/media/qt_design/4.jpg'); ?>" class="bg">
    <div class="content">
        <table style="width:100%;">
            <tr>
                <td style="padding: 282px 0 0 163px;"><?php echo $project->project_type ?? '________'; ?></td>
            </tr>
            <tr>
                <td style="padding: 10px 0 0 168px;"><?php echo $products[0]->product_type ?? 'My-type'; ?></td>
            </tr>
        </table>

        <!-- Product Table -->
        <div style="position:absolute; top:423px; left:0; right:0;">
            <table style="width:100%; font-size:11px;">
                <thead>
                    <tr>
                        <th style="border:1px solid #ccc; padding:4px;">No.</th>
                        <th style="border:1px solid #ccc; padding:4px;">Product Name</th>
                        <th style="border:1px solid #ccc; padding:4px;">Brand</th>
                        <th style="border:1px solid #ccc; padding:4px;">Warranty</th>
                        <th style="border:1px solid #ccc; padding:4px;">Watt / Volt</th>
                        <th style="border:1px solid #ccc; padding:4px;">Total No. of Pieces</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($products as $p): ?>
                    <tr>
                        <td style="border:1px solid #ccc; padding:4px;"><?php echo $i++; ?></td>
                        <td style="border:1px solid #ccc; padding:4px;"><?php echo $p->productName; ?></td>
                        <td style="border:1px solid #ccc; padding:4px;"><?php echo $p->brandName; ?></td>
                        <td style="border:1px solid #ccc; padding:4px;"><?php echo $p->warranty; ?></td>
                        <td style="border:1px solid #ccc; padding:4px;"><?php echo $p->watt_volt.'W'; ?></td>
                        <td style="border:1px solid #ccc; padding:4px;"><?php echo $p->quantity; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ========= PAGE 5 ========= -->
<div class="page">
    <img src="<?php echo base_url('assets/media/qt_design/5.jpg'); ?>" class="bg">
</div>

</body>
</html>