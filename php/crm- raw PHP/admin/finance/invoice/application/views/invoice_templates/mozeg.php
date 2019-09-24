<div id="header" class="clearfix">
    <div class="left">
        <p class="date"><?php 
            $dateString = date_from_mysql($invoice->invoice_date_created, TRUE);
            echo strftime("%e. %B %Y", strtotime($dateString));
        ?></p>

        <h2 class="invoice"><?php echo lang('invoice'); ?> <?php echo $invoice->invoice_number; ?></h2>

        <p><strong>NAROČNIK: </strong><?php echo $invoice->client_name; ?></p>

        <p>
            <?php
                $address = array();

                if ($invoice->client_address_1) { array_push($address, $invoice->client_address_1); }
                if ($invoice->client_address_2) { array_push($address, $invoice->client_address_2); }
                if ($invoice->client_city) {
                    $city = $invoice->client_city;
                    if ($invoice->client_zip) { $city = $invoice->client_zip . ' ' . $city; }
                    array_push($address, $city);
                }
                if ($invoice->client_state) { array_push($address, $invoice->client_state); }
                if ($invoice->client_country) { array_push($address, $invoice->client_country); }

                if (count($address) > 0) {
                    echo '<strong>' . lang('address') . ': </strong>';
                    echo implode(', ', $address);
                }
            ?>
        </p>

        <?php
            if ($invoice->client_custom_id_tevilka_za_ddv) { 
                echo '<p><strong>ID ŠT. ZA DDV: </strong>' . $invoice->client_custom_id_tevilka_za_ddv . '</p>'; 
            } else if ($invoice->client_custom_davcna_tevilka) { 
                echo '<p><strong>DAVČNA ŠTEVILKA: </strong>' . $invoice->client_custom_davcna_tevilka . '</p>'; 
            }
        ?>

        <?php if ($invoice->invoice_custom_datum_storitve) { echo '<p><strong>DATUM STORITVE: </strong>' . $invoice->invoice_custom_datum_storitve . '</p>'; } ?>

        <?php 
            $dateString = date_from_mysql($invoice->invoice_date_due, TRUE);
            echo '<p><strong>Datum zapadlosti: </strong>' . strftime("%e. %B %Y", strtotime($dateString)) . '</p>'; ?>
    </div>

    <div class="right">
        <img width="202" height="55" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABO4AAAFYCAYAAADk07N8AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA7RpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcFJpZ2h0czpNYXJrZWQ9IkZhbHNlIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InV1aWQ6QjdCMUQ5M0YzMjY4RTAxMTgwREE5MDFBOEUyNTA3ODkiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QzA5M0UxQzk2OUMxMTFFMzhGOEZDOTNEMzE5QzFCRDgiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QzA5M0UxQzg2OUMxMTFFMzhGOEZDOTNEMzE5QzFCRDgiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6YWRlOTRiNWItZTgzMi00MjJjLTllZjAtMDVjZjIyNWYz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" />
        <?php if ($invoice->user_name) { echo '<p class="first">' . $invoice->user_name . '</p>'; } ?>

        <?php if ($invoice->user_address_1) { echo '<p>' . $invoice->user_address_1 . '</p>'; } ?>

        <?php echo '<p>';
              if ($invoice->user_zip) { echo $invoice->user_zip; }
              if ($invoice->user_city) { echo ' ' . $invoice->user_city; }
              echo '</p>';
        ?>

        <?php if ($invoice->user_country) { echo '<p>' . $invoice->user_country . '</p>'; } ?>

        <?php if ($invoice->user_custom_epota) { echo '<p>' . $invoice->user_custom_epota . '</p>'; } ?>

        <?php if ($invoice->user_custom_id_tevilka_za_ddv) { echo '<p>ID št. za DDV: ' . $invoice->user_custom_id_tevilka_za_ddv . '</p>'; } ?>
    </div>
</div>

<div id="invoice-items">
    <?php if ($invoice->invoice_custom_popust > 0) {
        $colspan = 3;
    } else {
        $colspan = 2;
    }
    ?>
    <table class="table" style="width: 100%;">
        <thead>
            <tr>
                <th>STORITEV</th>
                <th><?php echo lang('qty'); ?></th>
                <th><?php echo lang('price'); ?></th>
                <?php if ($invoice->invoice_custom_popust > 0) { echo "<th>POPUST</th>"; } ?>
                <?php if ($invoice->invoice_item_tax_total > 0) { echo "<th>DDV</th>"; } ?>
                <th class="last">ZNESEK&nbsp;<?php if ($invoice->invoice_item_tax_total > 0) { echo "BREZ&nbsp;DDV"; } ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) { ?>
                <tr>
                    <td><?php echo $item->item_description; ?></td>
                    <td><?php echo format_amount($item->item_quantity); ?></td>
                    <td><?php echo format_currency($item->item_price); ?></td>
                    <?php if ($invoice->invoice_custom_popust) { echo '<td>' . $invoice->invoice_custom_popust . ' %</td>'; }?>
                    <?php
                        if ($invoice->invoice_item_tax_total > 0) {
                            echo '<td>';
                            foreach ($tax_rates as $tax_rate) { 
                                if ($item->item_tax_rate_id == $tax_rate->tax_rate_id) {
                                    echo str_replace(".", ",", $tax_rate->tax_rate_percent) . " %";
                                }
                            }
                            echo '</td>';
                        } 
                    ?>
                    <td class="last"><?php echo format_currency($item->item_subtotal); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <?php if ($invoice->invoice_item_tax_total > 0) { 
                $notax = false;
                $colspan++;
            ?>
            <tr class="border-top">
                <td colspan="<?php echo $colspan; ?>"></td>
                <td style="padding-top: 1em;">SKUPAJ&nbsp;BREZ&nbsp;DDV</td>
                <td class="last" style="padding-top: 1em;"><?php echo format_currency($invoice->invoice_item_subtotal); ?></td>
            </tr>
            <tr>
                <td colspan="<?php echo $colspan; ?>"></td>
                <td>DDV</td>
                <td class="last"><?php echo format_currency($invoice->invoice_item_tax_total); ?></td>
            </tr>
            <?php } else {
                $notax = true;
            } ?>
            <tr class="<?php if ($notax == true) { ?>border-top <?php } ?>border-bottom">
                <td colspan="<?php echo $colspan; ?>"></td>
                <td style="<?php if ($notax == true) { ?>padding-top: 1em;<?php } ?>padding-bottom: 1em;"><strong>ZA&nbsp;PLAČILO</strong></td>
                <td class="last" style="<?php if ($notax == true) { ?>padding-top: 1em;<?php } ?>padding-bottom: 1em;"><strong><?php echo format_currency($invoice->invoice_total) ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>

<div id="bank-info">
    <p>
    <?php 
            if ($invoice->user_custom_banka) { 
                echo '<span><strong>BANKA: </strong>' . $invoice->user_custom_banka . '</span>';
            }
            
            if ($invoice->user_custom_swiftbic) {
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<span><strong>SWIFT-BIC: </strong>' . $invoice->user_custom_swiftbic . '</span>'; 
            }

            if ($invoice->user_custom_iban) {
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<span><strong>IBAN: </strong>' . $invoice->user_custom_iban . '</span>'; 
            } 
    ?>
    </p>
</div>

<div id="footer">
    <h2 style="padding-bottom: 15px;text-align:center;">Hvala za zaupanje.</h2>

    <?php if ($invoice->invoice_terms) { ?>
    <p class="footnote" style="padding-left: 8px;font-size: 11px;"><strong>OPOMBA: </strong><?php echo nl2br($invoice->invoice_terms); ?></p>
    <?php } ?>
</div>
