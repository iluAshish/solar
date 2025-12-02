<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quotation</title>
    <style>
        @media print {
            .row.pagebreak,
            .d-flex,
            .flex-stack,
            .flex-wrap {
                display: block !important;
                width: 100% !important;
            }

            .row.pagebreak {
                page-break-after: always !important;
                break-after: page !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .row.pagebreak:last-of-type {
                page-break-after: auto !important;
                break-after: auto !important;
            }

            * {
                page-break-before: auto !important;
                page-break-inside: avoid !important;
            }

            .row.pagebreak:empty {
                display: none !important;
                page-break-after: auto !important;
                break-after: auto !important;
            }

            .btn, .no-print {
                display: none !important;
            }
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .page {
            position: relative;
            width: 210mm;
            height: 297mm;
            margin: 0 auto 10mm;
            page-break-before: always;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .content-overlay {
            position: relative;
            z-index: 2;
            padding: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 4px 6px;
            font-size: 13px;
            color: black;
        }

        .table-overlay {
            position: absolute;
            top: 423px;
            left: 0;
            right: 0;
            z-index: 3;
            height: 630px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        .no-print {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- PAGE 1 -->
<div class="row pagebreak page" style="background-image: url('<?php echo base_url()?>assets/media/qutation-design/1.jpg');">
    <div class="content-overlay">
        <table>
            <tr>
                <td style="padding: 236px 0 0 74px;">
                    <?php echo date('d-m-Y', strtotime($data_info->qauote_date)); ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 4px 0 0 563px;">
                    <?php echo $data_info->reference_no ?? "________"; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 0 0 143px;">
                    <?php echo $franchisee->franchisee_code ?? "_______"; ?>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td style="padding: 100px 2px 0 98px;">
                    <?php echo $client->client_name ?? '_________'; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 9px 2px 0 113px;">
                    <?php echo $client->client_email ?? '________'; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 2px 0 163px;">
                    <?php echo $client->phone ?? '________'; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 6px 149px 1px 143px;">
                    <?php echo $client->address ?? '________'; ?>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td style="padding: 108px 0 0 172px;">
                    <?php echo $vendor->vendor_name ?? '________'; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 21px 0 0 172px;">
                    <?php echo $vendor->state_name ?? '________'; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 14px 0 0 172px;">
                    <?php echo $vendor->address ?? '_______'; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 27px 0 0 172px;">
                    <?php echo $vendor->gstin_number ?? '_______'; ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 25px 0 0 232px;">
                    <?php echo $vendor->account_number ?? '________ '; ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- PAGE 2 -->
<div class="row pagebreak page" style="background-image: url('<?php echo base_url()?>assets/media/qutation-design/2.jpg');">
    <table>
        <tr>
            <td style="padding: 257px 2px 0 126px;">
                <?php echo $project->project_name ?? '__________________________________________________'; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 9px 1px 669px 185px;">
                <?php echo $project->qty . 'KW' ?? '_________'; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 1px 0 194px; position: relative; top: -663px;">
                <?php echo $project->project_type ?? ' ________'; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 1px 0 194px; position: relative; top: -643px;">
                <?php echo $project->basic_rate ?? '______'; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 1px 0 214px; position: relative; top: -634px;">
                <?php echo $project->amount ?? '_______'; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 1px 1px 0 188px; position: relative; top: -617px;">
                <?php echo $data_info->work_scope ?? ' NA'; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 1px 1px 0 240px; position: relative; top: -594px;">
                <?php echo $data_info->specification ?? 'NA'; ?>
            </td>
        </tr>
    </table>
</div>

<!-- PAGE 3 -->
<div class="row pagebreak page" style="background-image: url('<?php echo base_url()?>assets/media/qutation-design/3.jpg');"></div>

<!-- PAGE 4 -->
<div class="row pagebreak page" style="background-image: url('<?php echo base_url()?>assets/media/qutation-design/4.jpg');">
    <table>
        <tr>
            <td style="padding: 282px 2px 0 163px;">
                <?php echo $project->project_type ?? '________'; ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 1px 787px 168px;">
                <div style="position: relative; top: 10px;">
                    <?php echo $products[0]->product_type ?? 'My-type'; ?>
                </div>
            </td>
        </tr>
    </table>

    <div class="table-overlay">
        <table class="table table-bordered" style="font-size:11px;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Warranty</th>
                    <th>Watt / Volt</th>
                    <th>Total No. of Pieces</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (!empty($products)) {
                    foreach ($products as $product) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $product->product_name; ?></td>
                            <td><?php echo $product->brand_name; ?></td>
                            <td><?php echo $product->warranty; ?></td>
                            <td><?php echo $product->watt_volt . 'W'; ?></td>
                            <td><?php echo $product->quantity; ?></td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- PAGE 5 -->
<div class="row pagebreak page" style="background-image: url('<?php echo base_url(); ?>assets/media/qutation-design/5.jpg');"></div>



</body>
</html>