   M S B A M L   `   `   `  ����R  NWindowsBase, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35\ XPresentationFramework, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35W SPresentationCore, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35R NSystem.Xaml, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089 !  MyScrollViewerControlTemplate  �� 
TargetType �Name � ColumnDefinitions � RowDefinitions ��Name ��Name �� CanContentScroll �� CanHorizontallyScroll �� CanVerticallyScroll	 ��Name4   .System.Windows.Automation.AutomationProperties
    AutomationId � Cursor �� ScrollableHeight � Maximum � Minimum* �� #ComputedVerticalScrollBarVisibility �� ViewportHeight �� ViewportSize  MyScrollBarStyle � Value �� Mode �� RelativeSource �� ScrollableWidth �� Orientation, �� %ComputedHorizontalScrollBarVisibility �� ViewportWidth  ScrollBarDisabledBackground �� Color  VerticalScrollBarPageButton �� 
TargetType �� Property �� Value&   System.Windows.Controls.DataGrid=  7System.Windows.Controls.Primitives.DataGridColumnHeader ��Name F�Name �� Stretch  J� RenderTransformOrigin)  #System.Windows.Controls.DataGridRow! �� Triggers" P� Property# P� Value*  $System.Windows.Controls.DataGridCell$ �� TextAlignment  ScrollBarThumb% �� RadiusX& �� RadiusY' �� Triggers( �� 
TargetName ! HorizontalScrollBarPageButton) J� SnapsToDevicePixels* ]�Name+ J� IsMouseOver, ]� DecreaseRepeatButton- �� PageUpCommand. ]� IncreaseRepeatButton/ �� PageDownCommand0 ]� Thumb1 �� PageLeftCommand2 �� PageRightCommand  ButtonStyle3 �� StrokeMiterLimit4 ��Name  ComboxStyleBtn5 �� Angle  BorderStyle 	 ComboBoxStyle6 �� 
IsReadOnly7 �� 
IsReadOnly8 �� Text9 �� CornerRadius: �� 	ClickMode; d� 	IsChecked< �� Path= �Name> �� IsDropDownOpen? � AllowsTransparency@ �� MaxDropDownHeightA � ActualWidthB J� Effect3  -System.Windows.Media.Effects.DropShadowEffectC   ColorD   
BlurRadiusE   ShadowDepthF   Opacity 
 ScrollViewerStyleG K� IsItemsHost-  'System.Windows.Input.KeyboardNavigationH   DirectionalNavigation  CornerButton  CornerTextBoxI ��Name  CornerPasswordBox�� 5      D 9http://schemas.microsoft.com/winfx/2006/xaml/presentation     :x,http://schemas.microsoft.com/winfx/2006/xaml      5      %�%  &	        &	 �    &	 �    '  G    '  �    '  T
    '  v    &	 �    &	 (    &	 p    7  7  7  7  7  7  7  7  &	     &	 ~    &	 .    &		     7  &	 #    &	 �#    &	 g$    �� 5      "  ��6<   .R�5   
   � $
 Grid��6   #��z��6    5      �� 5      $��* �6#   �� 5      $
��Auto �6#    5
      �� 5      $��* �6    �� 5      $
��Auto �6    .+�5      �� $ Corner��6   $��1��6(   
�������$��1��6E   �� 5      $! PART_ScrollContentPresenter��6%   # z��6J    .   .  #��z��6�   #��z��6�   $��0��6  #��z��6"  $��0��6E  �� 5      $	 PART_VerticalScrollBar��6   $
 VerticalScrollBar��68   $ Arrow��6n   $��1��6}   # z 6�   $ 0Q�6�   $��0��6�   #y�z 6�   # z 6u  #���  6�   6  �� *VerticalOffset+$ OneWay=� �� *TemplatedParent+6�  �� 5      $	 PART_HorizontalScrollBar��6   $
 HorizontalScrollBar��6:   $ Arrow��6r   $��0��6�   # z 6�   $ 0Q�6�   $ 
Horizontal=�6�   $��1��6�   #y�z 6�   # z 6�  #���  6�   64  �� *HorizontalOffset+$ OneWay=� �� *TemplatedParent+6�  5      5      �� 5      $ #F4F4F4��6:   �� 5      " ��60   .�5   
   ��  �@�OverridesDefaultStyle . 62   �� 5   
    � ��
 ���� 6'   �� 5   
    � |� .  6&   �� 5   
    � �� .  6&   �� 5   
    � �� 5      �� 5      "  ��6"   .R�5      �� #��z��6    #��z��6D   #��z��6f   5      5!      5"      �� 5#      "  6   .�5%   
   ��  �@ CanUserResizeColumns .  61   �� 5&   
    � ��
 ���� 6'   �� 5'   
    � ��
 ���� 6(   �� 5(   
     �@ HorizontalGridLinesBrush 5)      �� 5*      $ Transparent��6"   5,      �� 5-   
    �@ VerticalGridLinesBrush 5.      �� 5/      $ Transparent��6"   51      52      �� 54      "  6   .�55   
   ��  �@J�SnapsToDevicePixels . 60   �� 56   
    � ��$ 0��6%   �� 57   
    � ��$ 0��6&   �� 58   
    � ��
 �   �6'   �� 59   
    � ��$ 14(�6%   �� 5:   
    �@�Cursor$
 Hand��6#   �� 5;   
    � �� 5<      �� 5=      "   6"   .R�5>      �� $ BackgroundBorder��6   $��0,1,0,1q�67   
������ $
��Auto��5@      ._�5A      �  5B      �� 5C   "   $��* �63   .+�5E      �� $��0,0,0,0q�60   $��Center=�6A   $��Center=�6\   F� 5F      $ 	SortArrow��6#   $y�	Collapsed=�66   "����        �@B     � � @B 	$
 Fill=�6f   $��2��6v   $��8��6�   $��6��6�   
�������$��0,0,50,0q�6�   $��Center=�5G      $	  1,1&�68   �� 5H      $��1��6(   
������ $��Right=�6E   $��1��6a   5K      5L      5M      5O      �� 5P   
    � ��$ 25��6#   5Q      �� 5T      "  6   .�5U   
   ��  � ��
 ���� 6'   �� 5V   
    � ��$ 25��6#   �� 5W   
    � ��
 �   �6'   ! 5X   
   P� 5Z      " �@ AlternationIndex$# 0��62   . �5[      ��  � ��
 ���� 6/   5\      P� 5]      " �@ AlternationIndex$# 1��62   . �5^      ��  � ��
 ���� 6/   5_      P� 5a      " �@J�IsMouseOver# . . �5b      ��  � ��
 �����6/   5d      P� 5f      " �@ 
IsSelected# . . �5g      ��  � ��
 �   �6/   5h      5j      �� 5m      "  6   .�5o   
   ��  � �� 5p      �� 5q      "   6"   .R�5r      �� $$ Center=�6    $��Center=�67   �� 5s      5t      5u      5w      ! 5x   
   P� 5y      " �@ 
IsSelected# . . �5|      ��  � ��
 �   �6/   5}      5      �� 5�      " n�6#   .�5�   
   ��  �@�OverridesDefaultStyle . 62   �� 5�   
    � �� .  6&   �� 5�   
    � �� 5�      �� 5�      "  n�6"   .R�5�      �� $��	thumbRect��6    
����d�$% 3��6G   $& 3��6S   ' 5�      P� 5�      " �@J�IsMouseOver# . . �5�      �� $( 	thumbRect��6B    � ��
 ��  �5�      5�      5�      5�      �� 5�      " ��62   .�5�   
   ��  �@�OverridesDefaultStyle . 62   �� 5�   
    � ��
 ���� 6'   �� 5�   
    � |� .  6&   �� 5�   
    � �� .  6&   �� 5�   
    � �� 5�      �� 5�      "  ��6"   .R�5�      �� #��z��6    #��z��6D   #��z��6f   5�      5�      5�      �� 5�      " ��6%   .�5�   
   ��  � ��
 �����6'   �� 5�   
    �@��IsPressAndHoldEnabled .  69   �� 5�   
    �@��IsFlicksEnabled .  63   �� 5�   
    � ��$ 6��6"   �� 5�   
    � ��$ 6��6%   �� 5�   
    � �� 5�      �� 5�      "  ��6"   .R�5�      � $ Bg��6   
�������) . $��6��6Y    5�      �� 5�      .+�5�      ]� $* 
PART_Track��6    ��. #{�z+ 6O   , 5�      �� 5�   "   #��Z- 6/   8��  6\   . 5�      �� 5�   "   #��Z/ 6/   8�� 6^   0 5�      n� 5�   "   8�� 6(   5�      5�      ' 5�      P� 5�      " � {�# .  . �5�      �� $( Bg��6;   8   � ��6K   5�      5�      5�      ! 5�   
   P� 5�      " �@��Orientation$# 
Horizontal=�6-   . �5�      ��  � ��$
 Auto��6*   �� 5�       � ��$ 0��6-   �� 5�       � ��$ 6��6+   �� 5�       � ��$ 6��6.   �� 5�       � ��
 �����6/   �� 5�       � �� 5�      �� 5�      "  ��6*   .R�5�      � $ Bg��6#   
�������) .  5�   "   �� 5�   &   .+�5�   "   ]� $* 
PART_Track��6(   #{�z+ 6=   , 5�   &   �� 5�   *   #��Z1 67   8�� 6f   . 5�   &   �� 5�   *   #��Z2 67   8�� 6g   0 5�   &   n� 5�   *   8�� 60   5�   #   5�      ' 5�      P� 5�   "   " � {�# .  . �5�   &   �� $( Bg��6C   8   � ��6S   5�   #   5�      5�      5�      5�      �� 5�      " ��6    .�5�   
   ��  � ��
 �   �6'   �� 5�   
    � �� 5�      �� 5�      "  ��6"   .R�5�      � .+�5�      �� $ 	Rectangle��6$   ���	#FFFFFFFF$3 1.000000Q�6J   $��0.500000��6f   $% 5��6�   $& 5��6�   
�������5�      �� 5�      $4 ContentPresenter��6+   #) z) 6E   #��z��6�   #��z��5�      ��. 6Y   5�      ' 5�      P� 5�      " �@J�IsMouseOver# . . �5�      �� $( 	Rectangle��65    � �� 5�   "   �� 5�   &   $ 	#FF4D7FEC��66   5�      �� 5�       � ��
 �����6K   5�      5�      5�      5�      �� 5�      " d�6   .�5�   
   ��  � �� 5      �� 5     .R�5     �� $
 Back��6   
������ $��1q�6D   
������ ._�5     F� $��PathFill��6   
�������$��8��6;   $��6��6E   $��0��6P   "����@KL     р�� ��� �    ��� 	$  0.5,0.5&�6   $
 Fill=�6�   z�5     V� 5  "   .~�5  &   �� �� 5  &   �� 5  &   $	5 180Q�66   T� 5	  &   5
  #   5     5     ' 5     P� 5     " �@J�IsMouseOver# . . �5     �� $( PathFill��6%    � ��
 �����6[   �� 5     $
( Back��6%    � ��
 ���� 6c   �� 5     $
( Back��6%    � ��
 ���� 6d   5     5     5     5     �� 5     " ��6    .�5  
   ��  � ��$ 2q�6,   �� 5  
    � ��
 �����6(   �� 5  
    �@��CornerRadius$ 12��6)   �� 5  
    � ��$ 0,20,0,0q�6#   �� 5  
    � ��$	 280��6"   5     �� 5      " ��6   .�5!  
   ��  � �� 5"     �� 5$     " ��6   .�5%     ��  � ��$ 22��62   6?   �� 5&      � ��$ 60��61   6>   �� 5'      � �� 5(     �� 5)     "  ��6.   .R�5*  "   �� $
��Back��6)   
������ $��0,0,0,0q�6O   ���#81D779._�5+  &   �� $��Center=�6X   $
��Left=�6s   $��	15,5,20,5q�6�   ��67   �� *Source+6�   5,  #   ' 5-  "   P� 5.  &   " �@J�IsMouseOver# . . �5/  *   �� $
( Back��61    � ��
 �����6m   50  '   P� 51  &   " �@��IsHighlighted# . . �52  *   �� $
( Back��61    � ��
 �����6m   53  '   55     57     58     5:     �� 5;  
    � �� 5<     �� 5=     "  ��6"   .R�5>     � 
������  5?     �� 5@     $
��0.7* �6/   �� 5A     $
��0.3* �6/   $��30��6<   .+�5C     �� $��0��6#   $��Center=�63   $��15px,0,20px,0q�6U   
�������#7 z6 6�   $��0q�6�   #��z8 6�   
������ 6�   �� 5D     $��0��6"   $��0q�62   ���#81D779$9 1,0,0,1��6\   5F     �� 5G     $��1��6!   $��0q�61   ���#81D779$9 0,1,1,0��6[   ._�5H     d� 8��  $: Press=�6�   ; 6S   �� $< IsDropDownOpen�$ TwoWay=� �� *TemplatedParent+6�   5I     � 5J     $= Popup��6]   #��z> 6    $��Bottom=�6J   |�.  ? . $��Slide=�6�   .��5K     �� $ DropDown��6�   $9 1��6%   #��z@ 66   #��zA 6f   ) . B 5L  "     5M  &   $C Black��67   $D 2Q�6E   $E 0Q�6T   $	F 0.5Q�6d   ._�5O  "   �� $��4,6,4,6q�6/   #��� 
 6@   #��z@ 6l   ) . $
��Auto=�6�   $
��Auto=�6�   ��. .��5Q  &   �� G . $H 	Contained=�6D   
�������6z   5R  #   5S     5T     5U     5V     5X     5Y     �� 5[     "  ��6,   .R�5\  
   �� 
��� � �$��1q�6%   $9 10��69   
���  ��._�5]     �� #��z��6   $��Center=�6R   $��Center=�6o   5^     5_     �� 5`     "  ��6-   .R�5a  
   �� 
�������$��0q�6$   $9 0��68   
������ ._�5b     �� $I PART_ContentHost��6   
�������$��Center=�6H   5c     5d     �� 5f     "  G�61   .R�5g  
   �� 
�������$��0q�6$   $9 0��68   
������ ._�5h     �� $I PART_ContentHost��6   $��Center=�65   5i     5j     5k     